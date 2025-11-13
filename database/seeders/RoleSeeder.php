<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions (if needed, but for this case, roles are enough)
        // Example: Permission::create(['name' => 'create carreras']);

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $profesorRole = Role::firstOrCreate(['name' => 'profesor']);
        $estudianteRole = Role::firstOrCreate(['name' => 'estudiante']);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'phone' => '3435410439',
                'dni' => '12345678',
                'address' => 'San Martín 123',
                'province_name' => 'Entre Rios',
                'city_name' => 'Nogoyá',
                'is_acepted' => 1
            ]
        );
        $admin->assignRole('administrador');

        // Create an example Profesor user
        $profesor = User::firstOrCreate(
            ['email' => 'profesor@example.com'],
            [
                'name' => 'Profesor User',
                'password' => Hash::make('password'),
                'dni' => '23456789',
                'phone' => '3435410440',
                'address' => 'Av. Belgrano 456',
                'province_name' => 'Entre Rios',
                'city_name' => 'Nogoyá',
                'is_acepted' => 1
            ]
        );
        $profesor->assignRole('profesor');

        // Create an example Estudiante user
        $estudiante = User::firstOrCreate(
            ['email' => 'estudiante@example.com'],
            [
                'name' => 'Estudiante User',
                'password' => Hash::make('password'),
                'dni' => '34567890',
                'phone' => '3435410441',
                'address' => 'Calle Libertad 789',
                'province_name' => 'Entre Rios',
                'city_name' => 'Nogoyá',
                'is_acepted' => 1
            ]
        );
        $estudiante->assignRole('estudiante');

        $this->command->info('Roles and initial users created successfully!');
    }
}
