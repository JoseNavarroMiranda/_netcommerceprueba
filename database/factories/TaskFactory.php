<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'is_completed' => fake()->boolean(),
            'user_id' => User::factory(),
            'company_id' => Company::factory(),
            'start_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'expired_at' => fake()->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
