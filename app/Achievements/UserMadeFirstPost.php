<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMadeFirstPost extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'PrvaObjava';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Naredili ste svojo prvo objavo!';
}
