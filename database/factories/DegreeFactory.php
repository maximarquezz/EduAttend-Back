<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Degree>
 */
class DegreeFactory extends Factory
{

    protected $model = Degree::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_name' => $this->faker->unique()->sentence(3)
        ];
    }

    public function configure(): static
    {
        return $this->sequence(
            ['degree_name' => 'Tecnicatura en Software'],
            ['degree_name' => 'Profesorado de Primaria'],
            ['degree_name' => 'Profesorade de Matemática'],
            ['degree_name' => 'Tecnicatura de Enfermería'],
        );
    }
}
