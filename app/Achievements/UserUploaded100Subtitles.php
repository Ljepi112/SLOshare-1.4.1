<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserUploaded100Subtitles extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '100NalaganjPodnapisov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 100 podnapisov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100;
}
