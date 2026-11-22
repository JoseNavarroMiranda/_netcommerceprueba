<?php

namespace App\Http\Requests;

use App\Rules\MaxPendingTasksPerUser;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                new MaxPendingTasksPerUser(5),
            ],
        ];
    }
}
