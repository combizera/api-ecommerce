<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Livros',
            'CDs',
            'Eletrônicos',
            'Roupas',
            'Brinquedos',
            'Móveis',
            'Esportes',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
        ];
    }
}
