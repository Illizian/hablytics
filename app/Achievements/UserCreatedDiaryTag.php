<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserCreatedDiaryTag extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "First Entry";

    /*
     * A small description for the achievement
     */
    public $description = "Create your first entry";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
