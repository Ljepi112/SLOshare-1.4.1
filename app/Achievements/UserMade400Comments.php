<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade400Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '400Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 400 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 400;
}
