<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded600Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '600NalaganjPodnapisov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 600 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 600;
}
