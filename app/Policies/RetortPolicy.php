<?php

namespace App\Policies;

use App\Models\Poll;
use App\Models\Retort;
use App\Models\User;

class RetortPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function delete(User $user, Retort $retort): bool
    {
        return $retort->user_id == $user->id;
    }
}
