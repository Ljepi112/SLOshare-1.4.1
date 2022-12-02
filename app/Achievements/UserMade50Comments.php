<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade50Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '50Komentarjev';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 50 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 50;
}
