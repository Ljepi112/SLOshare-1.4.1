<?php

namespace App\Console\Commands;

use App\Models\PersonalFreeleech;
use App\Models\PrivateMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRemovePersonalFreeleechTest
 */
class AutoRemovePersonalFreeleech extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:remove_personal_freeleech';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno odstrani osebni Freeleech uporabnikov, če je potekel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $personalFreeleech = PersonalFreeleech::where('created_at', '<', $current->copy()->subDays(1)->toDateTimeString())->get();

        foreach ($personalFreeleech as $pfl) {
            // Send Private Message
            $pm = new PrivateMessage();
            $pm->sender_id = 1;
            $pm->receiver_id = $pfl->user_id;
            $pm->subject = 'Osebni 24-urni Freeleech je potekel';
            $pm->message = 'Vaš [b]Osebni 24-urni Freeleech[/b] je poteklo! Lahko ga znova omogočite v trgovini BON Store! [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
            $pm->save();

            // Delete The Record From DB
            $pfl->delete();
        }

        $this->comment('Uporabniški osebni ukaz Freeleech za avtomatsko odstranjevanje je dokončan');
    }
}
