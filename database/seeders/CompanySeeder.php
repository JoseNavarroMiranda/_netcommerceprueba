<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($companyId = 1; $companyId <= 3; $companyId++) {
            Company::updateOrCreate(
                ['id' => $companyId],
                ['name' => 'Netcommerce'],
            );
        }
    }
}
