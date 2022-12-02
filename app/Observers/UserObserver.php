<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //\cache()->put(\sprintf('user:%s', $user->passkey), $user);
    }

    /**
     * Handle the User "saved" event.
     *
     *
     * @throws \Exception
     */
    public function saved(User $user): void
    {
        //\cache()->put(\sprintf('user:%s', $user->passkey), $user);
        \cache()->forget('cachedUser.'.$user->id);
    }

    /**
     * Handle the User "retrieved" event.
     */
    public function retrieved(User $user): void
    {
        //\cache()->add(\sprintf('user:%s', $user->passkey), $user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //\cache()->forget(\sprintf('user:%s', $user->passkey));
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //\cache()->put(\sprintf('user:%s', $user->passkey), $user);
    }
}
