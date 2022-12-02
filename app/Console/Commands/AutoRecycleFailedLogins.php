<?php

namespace App\Console\Commands;

use App\Models\FailedLoginAttempt;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRecycleFailedLoginsTest
 */
class AutoRecycleFailedLogins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:recycle_failed_logins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recikliraj neuspele prijave, stare 30 dni.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $failedLogins = FailedLoginAttempt::where('created_at', '<', $current->copy()->subDays(30)->toDateTimeString())->get();

        foreach ($failedLogins as $failedLogin) {
            $failedLogin->delete();
        }

        $this->comment('Ukaz za samodejno čiščenje starih neuspešnih prijav je dokončan');
    }
}
