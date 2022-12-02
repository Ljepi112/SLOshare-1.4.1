<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade900Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '900Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 900 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 900;
}
