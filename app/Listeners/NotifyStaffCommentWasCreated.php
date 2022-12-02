<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Models\User;
use App\Notifications\StaffCommentCreated;
use Illuminate\Support\Facades\Notification;

class NotifyStaffCommentWasCreated
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
    public function handle(CommentCreated $event): void
    {
        $staff = User::where(['is_modo' => 1])->limit(1)->get();
        Notification::send($staff, new StaffCommentCreated($event->comment));
    }
}
