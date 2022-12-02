<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserFilled50Requests extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'Izpolnjenih50Zahtev';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Izpolnili ste že 50 zahtev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 50;
}
