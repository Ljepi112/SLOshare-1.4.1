<?php

namespace App\Listeners;

use App\Events\TicketWentStale;
use App\Notifications\UserTicketStale;

class NotifyUserTicketIsStale
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
    public function handle(TicketWentStale $event): void
    {
        $event->ticket->user->notify(new UserTicketStale($event->ticket));
        $event->ticket->update(['reminded_at' => \time()]);
    }
}
