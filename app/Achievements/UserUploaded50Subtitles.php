<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded50Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '50NalaganjPodnapisov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 50 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 50;
}
