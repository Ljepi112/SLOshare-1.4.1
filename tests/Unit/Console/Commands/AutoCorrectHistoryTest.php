<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoCorrectHistory
 */
class AutoCorrectHistoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:correct_history')
            ->expectsOutput('Ukaz za samodejno popravljanje zapisov zgodovine je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
