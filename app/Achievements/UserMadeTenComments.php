<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMadeTenComments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '10Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 10 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;

    /*
     * Triggers whenever an Achiever makes progress on this achievement
     */
    public function whenProgress($progress): void
    {
    }

    /*
     * Triggers whenever an Achiever unlocks this achievement
     */
    public function whenUnlocked($progress): void
    {
    }
}
