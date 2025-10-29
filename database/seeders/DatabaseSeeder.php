<?php

namespace Database\Seeders;

use App\Models\MidComissionSubject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            RoleSeeder::class,
            DegreeSeeder::class,
            SubjectSeeder::class,
            ComissionSeeder::class,
            MidComissionSubjectSeeder::class,
            AssignmentSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
