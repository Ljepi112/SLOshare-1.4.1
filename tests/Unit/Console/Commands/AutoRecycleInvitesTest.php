<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoRecycleInvites
 */
class AutoRecycleInvitesTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:recycle_invites')
            ->expectsOutput('Ukaz za samodejno čiščenje nesprejetih povabil je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
