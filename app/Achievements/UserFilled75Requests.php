<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserFilled75Requests extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'Izpolnjenih75Zahtev';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Izpolnili ste že 75 zahtev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 75;
}
