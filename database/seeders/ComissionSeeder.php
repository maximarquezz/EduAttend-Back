<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comission;

class ComissionSeeder extends Seeder
{
    public function run(): void
    {
        Comission::insert([
            [
                'comission_name' => 'A',
                'comission_year' => 3,
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $this->command->info('Comisiones creadas exitosamente!');
    }
}
