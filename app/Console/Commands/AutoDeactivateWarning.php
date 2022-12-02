<?php

namespace App\Console\Commands;

use App\Models\PrivateMessage;
use App\Models\Warning;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoDeactivateWarningTest
 */
class AutoDeactivateWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:deactivate_warning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno deaktivira opozorila uporabnika, če je poteklo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $warnings = Warning::with(['warneduser', 'torrenttitle'])->where('active', '=', 1)->where('expires_on', '<', $current)->get();

        foreach ($warnings as $warning) {
            // Set Records Active To 0 in warnings table
            $warning->active = '0';
            $warning->save();

            // Send Private Message
            $pm = new PrivateMessage();
            $pm->sender_id = 1;
            $pm->receiver_id = $warning->warneduser->id;
            $pm->subject = 'Opozorilo je poteklo';
            if (isset($warning->torrent)) {
                $pm->message = '[b]OPOZORILO[/b] ki ste ga prejeli v zvezi s Torrentom '.$warning->torrenttitle->name.' je poteklo! Poskusite ga ne dobiti več! [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
            } else {
                $pm->message = '[b]OPOZORILO[/b] ki ste ga prejeli: "'.$warning->reason.'" je poteklo! [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
            }

            $pm->save();
        }

        $this->comment('Samodejni ukaz za deativacijo opozorila končan');
    }
}
