<?php

namespace App\Listeners;

use App\Events\TicketClosed;
use App\Models\User;
use App\Notifications\StaffTicketClosed;
use Illuminate\Support\Facades\Notification;

class NotifyStaffTicketWasClosed
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
        $staff = User::where(['is_modo' => 1])->limit(1)->get();
        Notification::send($staff, new StaffTicketClosed($event->ticket));
    }
}
