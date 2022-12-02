<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoHighspeedTag
 */
class AutoHighspeedTagTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:highspeed_tag')
            ->expectsOutput('Ukaz za avtomatizirane hitre torrente je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
