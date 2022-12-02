<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMade800Uploads extends Achievement
{
    /*
     * The achievement name
     */
    public $name = '800NalaganjTorrentov';

    /*
     * A small description for the achievement
     */
    public $description = 'Naložili ste 800 torrentov!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 800;
}
