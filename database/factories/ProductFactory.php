<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'quantity' => $this->faker->numberBetween(1, 100000),
            'price' => $this->faker->randomFloat(2, 1, 1000000000),
        ];
    }
}