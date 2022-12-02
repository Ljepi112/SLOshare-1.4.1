<?php

namespace App\Http\Controllers;

use App\Bots\IRCAnnounceBot;
use App\Models\FeaturedTorrent;
use App\Models\FreeleechToken;
use App\Models\Torrent;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\TorrentControllerTest
 */
class TorrentBuffController extends Controller
{
    /**
     * TorrentController Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
    }

    /**
     * Bump A Torrent.
     */
    public function bumpTorrent(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo || $user->group->is_internal, 403);
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $torrent->bumped_at = Carbon::now();
        $torrent->save();

        // Announce To Chat
        $torrentUrl = \href_torrent($torrent);
        $profileUrl = \href_profile($user);

        $this->chatRepository->systemMessage(
            \sprintf('OPOZORILO, [url=%s]%s[/url] je naletel na vrh [url=%s]%s[/url]! Uporabilo bi lahko več semen!', $torrentUrl, $torrent->name, $profileUrl, $user->username)
        );

        // Announce To IRC
        if (\config('irc-bot.enabled')) {
            $appname = \config('app.name');
            $ircAnnounceBot = new IRCAnnounceBot();
            $ircAnnounceBot->message(\config('irc-bot.channel'), '['.$appname.'] Uporabnik '.$user->username.' je udaril '.$torrent->name.' , lahko bi porabil več semen!');
            $ircAnnounceBot->message(\config('irc-bot.channel'), '[Kategorija: '.$torrent->category->name.'] [Vrsta: '.$torrent->type->name.'] [Velikost:'.$torrent->getSize().']');
            $ircAnnounceBot->message(\config('irc-bot.channel'), \sprintf('[Povezava: %s]', $torrentUrl));
        }

        return \to_route('torrent', ['id' => $torrent->id])
            ->withSuccess('Torrent je bil uspešno dvignjen na vrh!');
    }

    /**
     * Sticky A Torrent.
     */
    public function sticky(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo || $user->group->is_internal, 403);
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $torrent->sticky = $torrent->sticky == 0 ? '1' : '0';
        $torrent->save();

        return \to_route('torrent', ['id' => $torrent->id])
            ->withSuccess('Stanje torrenta je bilo prilagojeno!');
    }

    /**
     * Freeleech A Torrent (1% to 100% Free).
     */
    public function grantFL(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo || $user->group->is_internal, 403);
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $torrentUrl = \href_torrent($torrent);
        $torrentFlAmount = $request->input('freeleech');

        $v = \validator($request->input(), [
            'freeleech' => 'numeric|not_in:0',
        ]);

        if ($v->fails()) {
            return \to_route('torrent', ['id' => $torrent->id])
                ->withErrors($v->errors());
        }

        if ($torrent->free == 0) {
            $torrent->free = $torrentFlAmount;
            $fl_until = $request->input('fl_until');
            if ($fl_until !== null) {
                $torrent->fl_until = Carbon::now()->addDays($request->input('fl_until'));
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bilo odobreno %s%% Freeleech za '.$request->input('fl_until').' dni. :stopwatch:', $torrentUrl, $torrent->name, $torrentFlAmount)
                );
            } else {
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bilo odobreno %s%% Freeleech! Prenesi, dokler lahko! :fire:', $torrentUrl, $torrent->name, $torrentFlAmount)
                );
            }
        } else {
            // Get amount of FL before revoking for chat announcement
            $torrentFlAmount = $torrent->free;
            $torrent->free = '0';

            $this->chatRepository->systemMessage(
                \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bil preklican %s%% Freeleech! :poop:', $torrentUrl, $torrent->name, $torrentFlAmount)
            );
        }

        $torrent->save();

        return \to_route('torrent', ['id' => $torrent->id])
            ->withSuccess('Torrent FL je bil prilagojen!');
    }

    /**
     * Feature A Torrent.
     */
    public function grantFeatured(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo || $user->group->is_internal, 403);
        $torrent = Torrent::withAnyStatus()->findOrFail($id);

        if ($torrent->featured == 0) {
            $torrent->free = '100';
            $torrent->doubleup = '1';
            $torrent->featured = '1';
            $torrent->save();

            $featured = new FeaturedTorrent();
            $featured->user_id = $user->id;
            $featured->torrent_id = $torrent->id;
            $featured->save();

            $torrentUrl = \href_torrent($torrent);
            $profileUrl = \href_profile($user);
            $this->chatRepository->systemMessage(
                \sprintf('Dame in Gospodje, [url=%s]%s[/url] je na drsnik za predstavljene torrente dodal [url=%s]%s[/url]! Prenesi, dokler lahko! :fire:', $torrentUrl, $torrent->name, $profileUrl, $user->username)
            );

            return \to_route('torrent', ['id' => $torrent->id])
                ->withSuccess('Torrent je zdaj predstavljen!');
        }

        return \to_route('torrent', ['id' => $torrent->id])
            ->withErrors('Torrent je že predstavljen!');
    }

    /**
     * UnFeature A Torrent.
     */
    public function revokeFeatured(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo, 403);

        $featured_torrent = FeaturedTorrent::where('torrent_id', '=', $id)->firstOrFail();

        $torrent = Torrent::withAnyStatus()->findOrFail($id);

        if (isset($torrent)) {
            $torrent->free = '0';
            $torrent->doubleup = '0';
            $torrent->featured = '0';
            $torrent->save();

            $appurl = \config('app.url');

            $this->chatRepository->systemMessage(
                \sprintf('Dame in Gospodje, [url=%s/torrents/%s]%s[/url] ni več predstavljen. :poop:', $appurl, $torrent->id, $torrent->name)
            );
        }

        $featured_torrent->delete();

        return \to_route('torrent', ['id' => $torrent->id])
            ->withSuccess('Preklicano predstavljeno iz Torrenta!');
    }

    /**
     * Double Upload A Torrent.
     */
    public function grantDoubleUp(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        \abort_unless($user->group->is_modo || $user->group->is_internal, 403);
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $torrentUrl = \href_torrent($torrent);

        if ($torrent->doubleup == 0) {
            $torrent->doubleup = '1';
            $du_until = $request->input('du_until');
            if ($du_until !== null) {
                $torrent->du_until = Carbon::now()->addDays($request->input('du_until'));
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bila odobreno dvojno nalaganje za '.$request->input('du_until').' dni. :stopwatch:', $torrentUrl, $torrent->name)
                );
            } else {
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bila odobreno dvojno nalaganje! Prenesi, dokler lahko! :fire:', $torrentUrl, $torrent->name)
                );
            }
        } else {
            $torrent->doubleup = '0';
            $this->chatRepository->systemMessage(
                \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bil preklican za dvojno nalaganje! :poop:', $torrentUrl, $torrent->name)
            );
        }

        $torrent->save();

        return \to_route('torrent', ['id' => $torrent->id])
            ->withSuccess('Torrent dvojno nalaganje je bil prilagojen!');
    }

    /**
     * Use Freeleech Token On A Torrent.
     */
    public function freeleechToken(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $activeToken = FreeleechToken::where('user_id', '=', $user->id)->where('torrent_id', '=', $torrent->id)->first();

        if ($user->fl_tokens >= 1 && ! $activeToken) {
            $freeleechToken = new FreeleechToken();
            $freeleechToken->user_id = $user->id;
            $freeleechToken->torrent_id = $torrent->id;
            $freeleechToken->save();

            $user->fl_tokens -= '1';
            $user->save();

            return \to_route('torrent', ['id' => $torrent->id])
                ->withSuccess('Za ta torrent ste uspešno aktivirali žeton Freeleech!');
        }

        return \to_route('torrent', ['id' => $torrent->id])
            ->withErrors('Nimate dovolj žetonov Freeleech ali pa imate enega že aktiviranega na tem torrentu.');
    }
}
