<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        Degree::insert([
            [
                'degree_name' => 'Tecnicatura Superior en Análisis y Desarrollo de Software',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Tecnicatura Superior en Enfermería',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Profesorado de Educación Primaria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Profesorado de Educación Secundaria en Matemática',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Profesorado de Educación Secundaria en Biología',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Profesorado de Educación Secundaria en Lengua y Literatura',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'degree_name' => 'Profesorado de Educación Secundaria en Historia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Carreras creadas exitosamente!');
    }
}
