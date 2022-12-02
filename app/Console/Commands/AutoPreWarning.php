<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\PrivateMessage;
use App\Models\Warning;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoPreWarningTest
 */
class AutoPreWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:prewarning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno pošilja predopozorilo PM uporabnikom';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        if (\config('hitrun.enabled')) {
            $carbon = new Carbon();
            $prewarn = History::with(['user', 'torrent'])
                ->where('prewarn', '=', 0)
                ->where('hitrun', '=', 0)
                ->where('immune', '=', 0)
                ->where('actual_downloaded', '>', 0)
                ->where('active', '=', 0)
                ->where('seedtime', '<=', \config('hitrun.seedtime'))
                ->where('updated_at', '<', $carbon->copy()->subDays(\config('hitrun.prewarn'))->toDateTimeString())
                ->get();

            foreach ($prewarn as $pre) {
                // Skip Prewarning if Torrent is NULL
                // e.g. Torrent has been Rejected by a Moderator after it has been downloaded and not deleted
                if (is_null($pre->torrent)) {
                    continue;
                }

                if (! $pre->user->group->is_immune && $pre->actual_downloaded > ($pre->torrent->size * (\config('hitrun.buffer') / 100))) {
                    $exsist = Warning::withTrashed()
                        ->where('torrent', '=', $pre->torrent->id)
                        ->where('user_id', '=', $pre->user->id)
                        ->first();
                    // Send Pre Warning PM If Actual Warning Doesnt Already Exsist
                    if ($exsist === null) {
                        $timeleft = \config('hitrun.grace') - \config('hitrun.prewarn');

                        // Send Private Message
                        $pm = new PrivateMessage();
                        $pm->sender_id = 1;
                        $pm->receiver_id = $pre->user->id;
                        $pm->subject = 'Hit in Run Opozorilo Dohodne';
                        $pm->message = 'Prejeli ste avtomatizirano [b]PRED OPOZORILO PM[/b] iz sistema, ker [b]ste bili ONEMOGOČENI za '.\config('hitrun.prewarn').\sprintf(' dni na Torrentu %s
                                            in še niso izvedli zahtevanih pravil o času sedma, ki jih določa ', $pre->torrent->name).\config('other.title').\sprintf('. Če ga ne boste sejali v %s prejmete avtomatizirano OPOZORILO, ki bo trajno ', $timeleft).\config('hitrun.expire').' dni![/b]
                                            [color=red][b] TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
                        $pm->save();

                        // Set History Prewarn
                        $pre->prewarn = 1;
                        $pre->save();
                    }
                }
            }
        }

        $this->comment('Samodejni ukaz pred opozorilom uporabnika končan');
    }
}
