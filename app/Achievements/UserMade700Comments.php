<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade700Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '700Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 700 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 700;
}
