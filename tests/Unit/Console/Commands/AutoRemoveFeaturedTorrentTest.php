<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoRemoveFeaturedTorrent
 */
class AutoRemoveFeaturedTorrentTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:remove_featured_torrent')
            ->expectsOutput('Ukaz za samodejno odstranjevanje predstavljenih torrentov je končan')
            ->assertExitCode(0)
            ->run();
    }
}
