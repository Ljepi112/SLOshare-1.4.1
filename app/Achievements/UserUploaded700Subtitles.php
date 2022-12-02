<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded700Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '700NalaganjPodnapisov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 700 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 700;
}
