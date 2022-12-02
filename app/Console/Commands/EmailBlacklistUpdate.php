<?php

namespace App\Console\Commands;

use App\Helpers\EmailBlacklistUpdater;
use Illuminate\Console\Command;

class EmailBlacklistUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:email-blacklist-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posodobite predpomnilnik za črno listo E-Mail domen.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $count = EmailBlacklistUpdater::update();

        if ($count === false) {
            $this->warn('Nobena domena ni bila pridobljena. Preverite email.blacklist.source ključ za potrditev konfiguracije.');

            return;
        }

        if ($count === 0) {
            $this->info('Nasvet: Črni seznam je bil pridobljen iz vira, vendar ni bilo navedenih 0 domen.');

            return;
        }

        $this->info(\sprintf('%s domene pridobljene. Predpomnilnik posodobljen. Pripravljeni ste.', $count));
    }
}
