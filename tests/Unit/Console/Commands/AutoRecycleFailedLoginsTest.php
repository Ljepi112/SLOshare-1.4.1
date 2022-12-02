<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoRecycleFailedLogins
 */
class AutoRecycleFailedLoginsTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:recycle_failed_logins')
            ->expectsOutput('Ukaz za samodejno čiščenje starih neuspešnih prijav je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
