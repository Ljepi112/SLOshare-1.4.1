<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * @see \App\Console\Commands\AutoRemovePersonalFreeleech
 */
class AutoRemovePersonalFreeleechTest extends TestCase
{
    /**
     * @test
     */
    public function it_runs_successfully(): void
    {
        $this->artisan('auto:remove_personal_freeleech')
            ->expectsOutput('Uporabniški osebni ukaz Freeleech za avtomatsko odstranjevanje je dokončan')
            ->assertExitCode(0)
            ->run();
    }
}
