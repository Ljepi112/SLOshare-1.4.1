<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\SyncPeers
 */
class SyncPeersTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:sync_peers')
            ->expectsOutput('Ukaz za sinhronizacijo Torrentov je končan')
            ->assertExitCode(0)
            ->run();
    }
}
