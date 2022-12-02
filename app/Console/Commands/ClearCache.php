<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * @see \Tests\Unit\Console\Commands\ClearCacheTest
 */
class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all_cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Počisti več običajnih predpomnilnikov ...";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment("Brisanje več običajnih predpomnilnikov ...");
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');
    }
}
