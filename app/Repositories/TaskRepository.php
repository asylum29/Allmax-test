<?php

namespace App\Repositories;

use App\Task;
use App\User;

class TaskRepository
{
    public function forUser(User $user, $status = -1, $priority = -1)
    {
        $query = $user->is_admin ? Task::query() : $user->tasks();
        switch ($status) {
            case 0:
            case 1:
            case 2:
                $query = $query->where('status', '=', $status);
        }
        switch ($priority) {
            case 0:
            case 1:
            case 2:
                $query = $query->where('priority', '=', $priority);
        }
        return $query->orderBy('created_at', 'asc')->get();
    }
}
