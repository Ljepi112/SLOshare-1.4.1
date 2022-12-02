<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class CheckForStaleTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:stale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pregledi za napake so odprte več kot 3 dni';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Ticket::checkForStaleTickets();
    }
}
