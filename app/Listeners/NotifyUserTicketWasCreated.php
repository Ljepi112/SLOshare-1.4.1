<?php

namespace App\Listeners;

use App\Events\TicketCreated;

class NotifyUserTicketWasCreated
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
    public function handle(TicketCreated $event): void
    {
    }
}
