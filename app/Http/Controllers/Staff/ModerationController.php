<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\TorrentHelper;
use App\Http\Controllers\Controller;
use App\Models\PrivateMessage;
use App\Models\Torrent;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\ModerationControllerTest
 */
class ModerationController extends Controller
{
    /**
     * ModerationController Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
    }

    /**
     * Torrent Moderation Panel.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $current = Carbon::now();
        $pending = Torrent::with(['user', 'category', 'type'])->pending()->get();
        $postponed = Torrent::with(['user', 'category', 'type'])->postponed()->get();
        $rejected = Torrent::with(['user', 'category', 'type'])->rejected()->get();

        return \view('Staff.moderation.index', [
            'current'   => $current,
            'pending'   => $pending,
            'postponed' => $postponed,
            'rejected'  => $rejected,
        ]);
    }

    /**
     * Approve A Torrent.
     */
    public function approve(int $id): \Illuminate\Http\RedirectResponse
    {
        $torrent = Torrent::withAnyStatus()->where('id', '=', $id)->first();

        if ($torrent->status !== 1) {
            $appurl = \config('app.url');
            $user = $torrent->user;
            $username = $user->username;
            $anon = $torrent->anon;

            // Announce To Shoutbox
            if ($anon == 0) {
                $this->chatRepository->systemMessage(
                    \sprintf('Uporabnik [url=%s/users/', $appurl).$username.']'.$username.\sprintf('[/url] je naložil '.$torrent->category->name.'. [url=%s/torrents/', $appurl).$torrent->id.']'.$torrent->name.'[/url] prenesi ga zdaj! :slight_smile:'
                );
            } else {
                $this->chatRepository->systemMessage(
                    \sprintf('Anonimni uporabnik je naložil '.$torrent->category->name.'. [url=%s/torrents/', $appurl).$torrent->id.']'.$torrent->name.'[/url] prenesi ga zdaj! :slight_smile:'
                );
            }

            TorrentHelper::approveHelper($torrent->id);

            return \to_route('staff.moderation.index')
                ->withSuccess('Torrent odobren');
        }

        return \to_route('staff.moderation.index')
            ->withErrors('Torrent je že odobren');
    }

    /**
     * Postpone A Torrent.
     */
    public function postpone(Request $request): \Illuminate\Http\RedirectResponse
    {
        $v = \validator($request->all(), [
            'id'      => 'required|exists:torrents',
            'slug'    => 'required|exists:torrents',
            'message' => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.moderation.index')
                ->withErrors($v->errors());
        }

        $user = $request->user();
        $torrent = Torrent::withAnyStatus()->where('id', '=', $request->input('id'))->first();
        $torrent->markPostponed();
        $privateMessage = new PrivateMessage();
        $privateMessage->sender_id = $user->id;
        $privateMessage->receiver_id = $torrent->user_id;
        $privateMessage->subject = \sprintf('Vaš naložen Torrent, %s, je bil preložen z strani %s', $torrent->name, $user->username);
        $privateMessage->message = \sprintf('Lep pozdrav,

 Vaš naložen Torrent, %s ,je bil preložen. Spodaj si oglejte sporočilo Osebja SLOshare.eu.

%s', $torrent->name, $request->input('message'));
        $privateMessage->save();

        return \to_route('staff.moderation.index')
            ->withSuccess('Torrent preložen');
    }

    /**
     * Reject A Torrent.
     */
    public function reject(Request $request): \Illuminate\Http\RedirectResponse
    {
        $v = \validator($request->all(), [
            'id'      => 'required|exists:torrents',
            'slug'    => 'required|exists:torrents',
            'message' => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.moderation.index')
                ->withErrors($v->errors());
        }

        $user = $request->user();
        $torrent = Torrent::withAnyStatus()->where('id', '=', $request->input('id'))->first();
        $torrent->markRejected();
        $privateMessage = new PrivateMessage();
        $privateMessage->sender_id = $user->id;
        $privateMessage->receiver_id = $torrent->user_id;
        $privateMessage->subject = \sprintf('Vaš naloženi Torrent, %s, je bil zavrnjen z strani %s', $torrent->name, $user->username);
        $privateMessage->message = \sprintf('Lep pozdrav,

 Vaš naloženi Torrent %s je bil zavrnjen. Spodaj si oglejte sporočilo Osebja SLOshare.eu.

%s', $torrent->name, $request->input('message'));
        $privateMessage->save();

        return \to_route('staff.moderation.index')
            ->withSuccess('Torrent zavrnjen');
    }
}
