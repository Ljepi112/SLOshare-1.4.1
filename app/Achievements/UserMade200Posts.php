<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade200Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '200Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 200 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 200;
}
