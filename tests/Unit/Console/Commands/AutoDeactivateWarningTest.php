<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoDeactivateWarning
 */
class AutoDeactivateWarningTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:deactivate_warning')
            ->expectsOutput('Samodejni ukaz za deativacijo opozorila končan')
            ->assertExitCode(0)
            ->run();
    }
}
