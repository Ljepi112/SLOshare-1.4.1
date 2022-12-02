<?php

namespace App\Console\Commands;

use App\Mail\TestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * @see \Tests\Todo\Unit\Console\Commands\TestMailSettingsTest
 */
class TestMailSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pošljite preizkusno E-Mail na račun lastnika s trenutno konfiguracijo pošte';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sysop = \config('other.email');

        $this->info('Pošiljanje testnega E-Mail na '.$sysop);
        \sleep(5);

        try {
            Mail::to($sysop)->send(new TestEmail());
        } catch (\Exception) {
            $this->error('Neuspešno!');
            $this->alert('E-Mail ni bilo mogoče poslati. Preverite svoje poštne nastavitve v .env datoteko.');
            exit(1);
        }

        $this->alert('E-Mail je bila uspešno poslana!');
    }
}
