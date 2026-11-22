<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function index(): JsonResponse
    {
        $companies = Company::with(['tasks.user'])
            ->get()
            ->map(fn (Company $company) => [
                'id' => $company->id,
                'name' => $company->name,
                'tasks' => $company->tasks->map(fn ($task) => [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                    'user' => $task->user->username,
                    'is_completed' => $task->is_completed,
                    'start_at' => $task->start_at?->format('Y-m-d H:i:s'),
                    'expired_at' => $task->expired_at?->format('Y-m-d H:i:s'),
                ]),
            ]);

        return response()->json($companies);
    }
}
