<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoBonAllocation
 */
class AutoBonAllocationTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:bon_allocation')
            ->expectsOutput('Ukaz za avtomatsko dodelitev BON je končan')
            ->assertExitCode(0)
            ->run();
    }
}
