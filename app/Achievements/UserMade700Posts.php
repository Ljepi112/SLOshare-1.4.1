<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade700Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '700Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 700 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 700;
}
