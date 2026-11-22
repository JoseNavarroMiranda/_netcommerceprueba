<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Rules\MaxPendingTasksPerUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id', new MaxPendingTasksPerUser(5)],
        ]);

        $task = Task::create([
            ...$validated,
            'is_completed' => false,
            'start_at' => now(),
            'expired_at' => null,
        ]);

        $task->load(['user', 'company']);

        return response()->json([
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'user' => $task->user->username,
            'company' => [
                'id' => $task->company->id,
                'name' => $task->company->name,
            ],
        ], 201);
    }
}
