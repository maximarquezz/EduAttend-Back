<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea 10 carreras y, por cada una, 20 unidades curriculares
        Degree::factory(4)
            ->has(Subject::factory()->count(10))
            ->create();
    }
}
