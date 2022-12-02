<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoWarning
 */
class AutoWarningTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:warning')
            ->expectsOutput('Ukaz za avtomatsko opozorilo uporabnika je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
