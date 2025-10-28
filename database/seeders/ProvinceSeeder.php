<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        Province::insert([
            [
                'province_name' => 'Buenos Aires',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Catamarca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Chaco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Chubut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Córdoba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Corrientes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Entre Ríos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Formosa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Jujuy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'La Pampa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'La Rioja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Mendoza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Misiones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Neuquén',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Río Negro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Salta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'San Juan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'San Luis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Santa Cruz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Santa Fe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Santiago del Estero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Tierra del Fuego',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_name' => 'Tucumán',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Provincias creadas exitosamente!');
    }
}
