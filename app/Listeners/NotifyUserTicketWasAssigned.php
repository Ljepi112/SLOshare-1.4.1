<?php

namespace App\Listeners;

use App\Events\TicketAssigned;

class NotifyUserTicketWasAssigned
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
    public function handle(TicketAssigned $event): void
    {
    }
}
