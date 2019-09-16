<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserCreated10DiaryTag extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "10 Entries";

    /*
     * A small description for the achievement
     */
    public $description = "Create 10 entries";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;
}
