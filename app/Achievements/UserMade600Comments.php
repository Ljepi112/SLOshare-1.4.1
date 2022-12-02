<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade600Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '600Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 600 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 600;
}
