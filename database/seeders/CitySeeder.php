<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Province;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $entreRios = Province::where('province_name', 'Entre Ríos')->first();

        $cities = [
            [
                'city_name' => 'Paraná',
                'city_postalcode' => 3100,
                'province_id' => $entreRios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_name' => 'Concordia',
                'city_postalcode' => 3200,
                'province_id' => $entreRios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_name' => 'Gualeguaychú',
                'city_postalcode' => 2820,
                'province_id' => $entreRios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_name' => 'Concepción del Uruguay',
                'city_postalcode' => 3260,
                'province_id' => $entreRios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_name' => 'Nogoyá',
                'city_postalcode' => 3150,
                'province_id' => $entreRios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        City::insert($cities);

        $this->command->info('Ciudades de Entre Ríos creadas exitosamente!');
    }
}
