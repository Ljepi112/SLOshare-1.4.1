<?php

namespace App\Achievements;

use Assada\Achievements\Achievement;

class UserMadeComment extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'PrviKomentar';

    /*
     * A small description for the achievement
     */
    public $description = 'Čestitamo! Podali ste svoj prvi komentar!';
}
