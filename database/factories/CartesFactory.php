<?php

namespace Database\Factories;

use App\Models\Cartes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cartes>
 */
class CartesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */

     protected $model = Cartes::class;
     
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence,
            'nom_entreprise' => $this->faker->company,
            // Define other attributes and their respective fake data generation
        ];
    }
}
