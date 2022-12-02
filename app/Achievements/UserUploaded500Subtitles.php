<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded500Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'UserUploaded500Subtitles';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 500 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 500;
}
