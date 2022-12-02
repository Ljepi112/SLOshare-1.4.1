<?php

namespace App\Listeners;

use App\Events\CommentCreated;

class NotifyUserCommentWasCreated
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
    }
}
