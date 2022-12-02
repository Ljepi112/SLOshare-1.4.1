<?php

namespace App\Traits;

trait UsersOnlineTrait
{
    /**
     * Check if the current user is online.
     */
    public function isOnline(): bool
    {
        if (! $this->last_action) {
            return false;
        }

        return $this->last_action->gt(\now()->subMinutes(5));
    }
}
