<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['category_type', 'manufacturer']),
        ];
    }
}