<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoRecycleAudits
 */
class AutoRecycleAuditsTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:recycle_activity_log')
            ->expectsOutput('Ukaz za samodejno čiščenje starih revizij je končan')
            ->assertExitCode(0)
            ->run();
    }
}
