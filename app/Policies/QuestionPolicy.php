<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function authorize(User $user, Question $question): bool
    {
        return $user->id == $question->user_id;
    }
}
