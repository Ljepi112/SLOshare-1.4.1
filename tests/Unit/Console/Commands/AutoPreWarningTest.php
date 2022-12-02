<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoPreWarning
 */
class AutoPreWarningTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:prewarning')
            ->expectsOutput('Samodejni ukaz pred opozorilom uporabnika končan')
            ->assertExitCode(0)
            ->run();
    }
}
