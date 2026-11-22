<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akira = User::where('username', 'Akira')->firstOrFail();
        $netcommerce = Company::where('name', 'Netcommerce')->firstOrFail();

        Task::updateOrCreate(
            ['name' => 'task 1', 'company_id' => $netcommerce->id],
            [
                'description' => 'task content',
                'user_id' => $akira->id,
                'is_completed' => 0,
                'start_at' => '2023-08-04 00:00:00',
                'expired_at' => '2023-08-07 00:00:00',
            ],
        );

        Task::updateOrCreate(
            ['name' => 'task 2', 'company_id' => $netcommerce->id],
            [
                'description' => 'task content',
                'user_id' => $akira->id,
                'is_completed' => 1,
                'start_at' => '2023-08-04 00:00:00',
                'expired_at' => null,
            ],
        );
    }
}
