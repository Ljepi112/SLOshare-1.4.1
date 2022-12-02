<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade600Uploads extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '600NalaganjTorrentov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 600 torrentov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 600;
}
