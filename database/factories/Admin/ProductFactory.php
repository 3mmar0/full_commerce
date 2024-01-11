<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word(2, true);
        return [
            'name:en' => $name,
            'disc:en' => $this->faker->sentence(12),
            'name:ar' => $this->faker->word(2, true),
            'disc:ar' => $this->faker->sentence(12),
            'image' => $this->faker->imageUrl(600, 600),
            'price:en' => $this->faker->randomFloat(1, 1, 500),
            'compare_price:en' => $this->faker->randomFloat(1, 501, 1000),
            'price:ar' => $this->faker->randomFloat(1, 1, 500),
            'compare_price:ar' => $this->faker->randomFloat(1, 501, 1000),
            'category_id' => Category::first()->id,
            'store_id' => Store::first()->id,
            'featured' => rand(0, 1)
        ];
    }
}
