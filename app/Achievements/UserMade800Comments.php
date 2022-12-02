<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade800Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '800Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 800 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 800;
}
