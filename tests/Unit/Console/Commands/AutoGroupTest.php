<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoGroup
 */
class AutoGroupTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:group')
            ->expectsOutput('Samodejni ukaz skupine uporabnikov je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
