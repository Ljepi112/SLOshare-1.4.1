<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade500Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '500Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 500 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 500;
}
