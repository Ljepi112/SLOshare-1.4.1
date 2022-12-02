<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoDisableInactiveUsers
 */
class AutoDisableInactiveUsersTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:disable_inactive_users')
            ->expectsOutput('Ukaz za samodejno onemogočitev uporabnika je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
