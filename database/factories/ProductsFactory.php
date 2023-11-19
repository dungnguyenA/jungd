<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => fake()->name(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount_price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->numerify(),
            'description' => fake()->text(),
            'view' => fake()->numerify(),
            'category_id' => fake()->numerify(),
            'brand_id' => fake()->numerify(),
        ];
    }
}
