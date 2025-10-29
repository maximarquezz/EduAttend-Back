<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        Enrollment::insert([
            [
                'user_id' => 1,
                'subject_id' => 1,
                'enrollment_year' => 2025,
                'enrollment_status' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $this->command->info('Inscripciones creadas exitosamente!');
    }
}
