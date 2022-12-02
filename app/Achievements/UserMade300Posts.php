<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade300Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '300Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 300 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 300;
}
