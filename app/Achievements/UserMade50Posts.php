<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade50Posts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '50Objave';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste že 50 objav!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 50;
}
