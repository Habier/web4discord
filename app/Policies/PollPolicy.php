<?php

namespace App\Policies;

use App\Models\Poll;
use App\Models\User;

class PollPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function delete(User $user, Poll $poll): bool
    {
        return $poll->user_id == $user->id;
    }
}
