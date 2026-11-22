<?php

namespace App\Rules;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPendingTasksPerUser implements ValidationRule
{
    public function __construct(private readonly int $limit = 5) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pendingTasks = Task::where('user_id', $value)
            ->where('is_completed', false)
            ->count();

        if ($pendingTasks >= $this->limit) {
            $fail("The user already has {$this->limit} pending tasks.");
        }
    }
}
