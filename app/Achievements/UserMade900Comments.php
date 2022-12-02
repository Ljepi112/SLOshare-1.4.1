<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade900Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '900Komentarji';

    /*
     * A small description for the achievement
     */
    public $description = 'Podali ste že 900 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 900;
}
