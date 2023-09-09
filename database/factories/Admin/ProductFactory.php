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
            'name' => $name,
            'slug' => Str::slug($name),
            'disc' => $this->faker->sentence(12),
            'image' => $this->faker->imageUrl(600, 600),
            'price' => $this->faker->randomFloat(1, 1, 500),
            'compare_price' => $this->faker->randomFloat(1, 501, 1000),
            'category_id' => Category::inrandomOrder()->first()->id,
            'store_id' => Store::inrandomOrder()->first()->id,
            'featured' => rand(0, 1)
        ];
    }
}
