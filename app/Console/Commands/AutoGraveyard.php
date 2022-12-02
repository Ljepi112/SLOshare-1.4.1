<?php

namespace App\Console\Commands;

use App\Models\Graveyard;
use App\Models\History;
use App\Models\PrivateMessage;
use App\Models\Torrent;
use App\Models\User;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoGraveyardTest
 */
class AutoGraveyard extends Command
{
    /**
     * AutoGraveyards Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:graveyard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno preverja zapise pokopališča za uspešna vstajenja';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Graveyard::where('rewarded', '!=', 1)->oldest()->get() as $reward) {
            $user = User::where('id', '=', $reward->user_id)->first();

            $torrent = Torrent::where('id', '=', $reward->torrent_id)->first();

            if (isset($user, $torrent)) {
                $history = History::where('torrent_id', '=', $torrent->id)
                    ->where('user_id', '=', $user->id)
                    ->where('seedtime', '>=', $reward->seedtime)
                    ->first();
            }

            if (isset($history)) {
                $reward->rewarded = 1;
                $reward->save();

                $user->fl_tokens += \config('graveyard.reward');
                $user->save();

                // Auto Shout
                $appurl = \config('app.url');

                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s/users/%s]%s[/url] je uspešno vstal [url=%s/torrents/%s]%s[/url]. :zombie:', $appurl, $user->username, $user->username, $appurl, $torrent->id, $torrent->name)
                );

                // Bump Torrent With FL
                $torrentUrl = \href_torrent($torrent);
                $torrent->bumped_at = Carbon::now();
                $torrent->free = 100;
                $torrent->fl_until = Carbon::now()->addDays(3);
                $this->chatRepository->systemMessage(
                    \sprintf('Dame in Gospodje, [url=%s]%s[/url] je bila odobrena 100%% Freeleech za 3 dni in je bil prilepljen na vrh. :stopwatch:', $torrentUrl, $torrent->name)
                );
                $torrent->save();

                // Send Private Message
                $pm = new PrivateMessage();
                $pm->sender_id = 1;
                $pm->receiver_id = $user->id;
                $pm->subject = 'Uspešno vstajenje pokopališča';
                $pm->message = \sprintf('Uspešno je vstal [url=%s/torrents/', $appurl).$torrent->id.']'.$torrent->name.'[/url] :zombie: ! Hvala, ker ste torrent vrnili od mrtvih! Uživajte v žetonih freeleech!
                [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
                $pm->save();
            }
        }

        $this->comment('Samodejni ukaz za nagrade pokopališča je končan');
    }
}
