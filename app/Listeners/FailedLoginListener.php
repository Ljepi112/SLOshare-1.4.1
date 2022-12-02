<?php

namespace App\Listeners;

use App\Models\FailedLoginAttempt;
use App\Models\Group;
use App\Notifications\FailedLogin;

class FailedLoginListener
{
    /**
     * Handle the event.
     *
     * @throws \Exception
     */
    public function handle($event): void
    {
        $bannedGroup = \cache()->rememberForever('banned_group', fn () => Group::where('slug', '=', 'banned')->pluck('id'));

        if (\property_exists($event, 'user') && $event->user instanceof \Illuminate\Database\Eloquent\Model
            && $event->user->group_id !== $bannedGroup[0]) {
            FailedLoginAttempt::record(
                $event->user,
                \request()->input('username'),
                \request()->ip()
            );

            $event->user->notify(new FailedLogin(
                \request()->ip()
            ));
        }
    }
}
