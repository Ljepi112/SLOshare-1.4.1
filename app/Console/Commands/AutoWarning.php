<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\PrivateMessage;
use App\Models\Warning;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoWarningTest
 */
class AutoWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:warning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno objavi opozorila uporabniškim računom in tabelo z opozorili';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        if (\config('hitrun.enabled')) {
            $carbon = new Carbon();
            $hitrun = History::with(['user', 'torrent'])
                ->where('actual_downloaded', '>', 0)
                ->where('prewarn', '=', 1)
                ->where('hitrun', '=', 0)
                ->where('immune', '=', 0)
                ->where('active', '=', 0)
                ->where('seedtime', '<', \config('hitrun.seedtime'))
                ->where('updated_at', '<', $carbon->copy()->subDays(\config('hitrun.grace'))->toDateTimeString())
                ->get();

            foreach ($hitrun as $hr) {
                if (! $hr->user->group->is_immune && $hr->actual_downloaded > ($hr->torrent->size * (\config('hitrun.buffer') / 100))) {
                    $exsist = Warning::withTrashed()
                        ->where('torrent', '=', $hr->torrent->id)
                        ->where('user_id', '=', $hr->user->id)
                        ->first();
                    // Insert Warning Into Warnings Table if doesnt already exsist
                    if ($exsist === null) {
                        $warning = new Warning();
                        $warning->user_id = $hr->user->id;
                        $warning->warned_by = '1';
                        $warning->torrent = $hr->torrent->id;
                        $warning->reason = \sprintf('Hit and Run Opozorilo za Torrent %s', $hr->torrent->name);
                        $warning->expires_on = $carbon->copy()->addDays(\config('hitrun.expire'));
                        $warning->active = '1';
                        $warning->save();

                        // Add +1 To Users Warnings Count In Users Table
                        $hr->hitrun = 1;
                        $hr->user->hitandruns++;
                        $hr->user->save();

                        // Send Private Message
                        $pm = new PrivateMessage();
                        $pm->sender_id = 1;
                        $pm->receiver_id = $hr->user->id;
                        $pm->subject = 'Prejeto opozorilo Hit and Run';
                        $pm->message = 'Prejeli ste avtomatsko [b]OPOZORILO[/b] iz sistema, ker [b]niste upoštevali pravil Hit and Run v zvezi s Torrentom '.$hr->torrent->name.'[/b]
                            [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
                        $pm->save();

                        $hr->save();
                    }
                }
            }
        }

        $this->comment('Ukaz za avtomatsko opozorilo uporabnika je dokončan');
    }
}
