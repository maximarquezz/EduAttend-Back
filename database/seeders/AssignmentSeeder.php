<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::insert([
            [
                'user_id' => 1,
                'mid_comissions_subjects_id' => 1,
                'assign_type' => 'CURSA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
