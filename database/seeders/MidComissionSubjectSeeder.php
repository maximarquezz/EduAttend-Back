<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MidComissionSubject;

class MidComissionSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MidComissionSubject::insert([
            [
                'subject_id' => 1,
                'comission_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
