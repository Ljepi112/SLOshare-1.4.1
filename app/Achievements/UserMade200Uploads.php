<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade200Uploads extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '200NalaganjTorrentov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 200 torrentov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 200;
}
