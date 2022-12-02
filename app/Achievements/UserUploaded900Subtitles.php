<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded900Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '900NalaganjPodnapisov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 900 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 900;
}
