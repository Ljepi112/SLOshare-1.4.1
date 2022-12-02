<?php

namespace App\Listeners;

use App\Models\User;
use App\Repositories\ChatRepository;
use Assada\Achievements\Event\Unlocked;
use Illuminate\Support\Facades\Session;

class AchievementUnlocked
{
    /**
     * AchievementUnlocked Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Unlocked $unlocked): void
    {
        // There's an AchievementProgress instance located on $event->progress
        $user = User::where('id', '=', $unlocked->progress->achiever_id)->first();
        Session::flash('achievement', $unlocked->progress->details->name);

        if ($user->private_profile == 0) {
            $profileUrl = \href_profile($user);

            $this->chatRepository->systemMessage(
                \sprintf('Uporabnik [url=%s]%s[/url] je odklenil %s dosežek :medal:', $profileUrl, $user->username, $unlocked->progress->details->name)
            );
        }
    }
}
