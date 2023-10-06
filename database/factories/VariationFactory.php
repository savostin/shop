<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Enums\VariationSizeEnum;
use App\Models\Enums\VariationColourEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first(),
            'image' => sprintf('%d.jpg', rand(1,9)),
            'size' => fake()->randomElement(VariationSizeEnum::values()),
            'colour' => fake()->randomElement(VariationColourEnum::values()),
            'price' => fake()->numberBetween($min=1, $max=10000) / 100.,
            'stock' => fake()->numberBetween($min=0, $max=100),
        ];
    }
}
