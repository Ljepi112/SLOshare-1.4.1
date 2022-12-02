<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserFilled25Requests extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'Izpolnjenih25Zahtev';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Izpolnili ste že 25 zahtev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 25;
}
