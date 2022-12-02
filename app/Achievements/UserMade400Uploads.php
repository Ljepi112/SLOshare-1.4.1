<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade400Uploads extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '400NalaganjTorrentov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 400 torrentov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 400;
}
