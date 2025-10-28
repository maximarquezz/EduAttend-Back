<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::insert([
            [
                'subject_name' => 'Análisis y Diseño de Sistemas II',
                'subject_year' => '3',
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name' => 'Programación III',
                'subject_year' => '3',
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_name' => 'Fundamentos de PHP 4',
                'subject_year' => '3',
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Materias creadas exitosamente!');
    }
}
