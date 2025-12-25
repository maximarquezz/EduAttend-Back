<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comission;

class ComissionSeeder extends Seeder
{
    public function run(): void
    {
        $comissions = [];

        // Profesorado de Educación Primaria (degree_id: 1) - 4 años
        for ($year = 1; $year <= 4; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 1,
                ];
            }
        }

        // Profesorado de Educación Secundaria en Matemática (degree_id: 2) - 4 años
        for ($year = 1; $year <= 4; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 2,
                ];
            }
        }

        // Profesorado de Educación Secundaria en Biología (degree_id: 3) - 4 años
        for ($year = 1; $year <= 4; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 3,
                ];
            }
        }

        // Profesorado de Educación Secundaria en Lengua y Literatura (degree_id: 4) - años 2, 3 y 4
        for ($year = 2; $year <= 4; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 4,
                ];
            }
        }

        // Profesorado de Educación Secundaria en Historia (degree_id: 5) - 4 años
        for ($year = 1; $year <= 4; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 5,
                ];
            }
        }

        // Tecnicatura Superior en Análisis y Desarrollo de Software (degree_id: 6) - 3 años
        for ($year = 1; $year <= 3; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 6,
                ];
            }
        }

        // Tecnicatura Superior en Enfermería (degree_id: 7) - 3 años
        for ($year = 1; $year <= 3; $year++) {
            foreach (['A', 'B', 'C'] as $letter) {
                $comissions[] = [
                    'comission_name' => $letter,
                    'comission_year' => $year,
                    'degree_id' => 7,
                ];
            }
        }

        // Agregar timestamps a todos los registros
        $comissionsWithTimestamps = array_map(function($comission) {
            return array_merge($comission, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $comissions);

        Comission::insert($comissionsWithTimestamps);

        $this->command->info('Comisiones creadas exitosamente!');
    }
}