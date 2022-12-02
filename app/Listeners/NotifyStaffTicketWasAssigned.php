<?php

namespace App\Listeners;

use App\Events\TicketAssigned;
use App\Models\User;
use App\Notifications\StaffTicketAssigned;
use Illuminate\Support\Facades\Notification;

class NotifyStaffTicketWasAssigned
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
        $staff = User::where(['is_modo' => 1])->limit(1)->get();
        Notification::send($staff, new StaffTicketAssigned($event->ticket));
    }
}
