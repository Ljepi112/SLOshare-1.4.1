<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\SetCache
 */
class SetCacheTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('set:all_cache')
            ->expectsOutput('Nastavitev več običajnih predpomnilnikov ...')
            ->assertExitCode(0)
            ->run();
    }
}
