<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade200Comments extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '200Komentarjev';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste že 200 komentarjev!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 200;
}
