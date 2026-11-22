<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

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
