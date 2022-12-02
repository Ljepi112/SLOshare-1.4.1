<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * @see \Tests\Unit\Console\Commands\SetCacheTest
 */
class SetCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:all_cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Nastavi več skupnih predpomnilnikov ...";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment("Nastavitev več običajnih predpomnilnikov ...");
        $this->call('view:cache');
        $this->call('route:cache');
        $this->call('config:cache');
    }
}
