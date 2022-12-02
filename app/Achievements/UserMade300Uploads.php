<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade300Uploads extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '300NalaganjTorrentov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 300 torrentov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 300;
}
