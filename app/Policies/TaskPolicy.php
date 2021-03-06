<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;
    
    public function __construct() { }

    public function delete(User $user, Task $task)
    {
        return $user->id == $task->user_id || $user->is_admin;
    }

    public function update(User $user, Task $task)
    {
        return $user->id == $task->user_id || $user->is_admin;
    }
}
