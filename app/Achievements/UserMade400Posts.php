<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade400Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '400Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 400 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 400;
}
