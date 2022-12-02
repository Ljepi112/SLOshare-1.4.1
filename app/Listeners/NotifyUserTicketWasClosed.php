<?php

namespace App\Listeners;

use App\Events\TicketClosed;

class NotifyUserTicketWasClosed
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TicketClosed $event): void
    {
    }
}
