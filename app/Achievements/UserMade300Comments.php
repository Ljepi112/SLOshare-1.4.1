<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade300Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '300Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 300 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 300;
}
