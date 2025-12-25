<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        Enrollment::insert([
            [
                'user_id' => 3, // estudiante@example.com
                'mid_comission_subject_id' => 1,
                'enrollment_year' => 2025,
                'enrollment_status' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $this->command->info('Inscripciones creadas exitosamente!');
    }
}