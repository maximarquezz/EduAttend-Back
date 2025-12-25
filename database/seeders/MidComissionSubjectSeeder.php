<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comission;
use App\Models\Subject;
use App\Models\MidComissionSubject;

class MidComissionSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Relacionando comisiones con materias...');

        // Obtener todas las comisiones
        $comissions = Comission::all();

        $relations = [];

        foreach ($comissions as $comission) {
            // Obtener todas las materias que corresponden al año y carrera de la comisión
            $subjects = Subject::where('degree_id', $comission->degree_id)
                              ->where('subject_year', $comission->comission_year)
                              ->get();

            // Crear la relación entre la comisión y cada materia
            foreach ($subjects as $subject) {
                $relations[] = [
                    'subject_id' => $subject->id,
                    'comission_id' => $comission->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insertar todas las relaciones
        MidComissionSubject::insert($relations);

        $this->command->info('Relaciones creadas exitosamente!');
        $this->command->info('Total de relaciones: ' . count($relations));
    }
}