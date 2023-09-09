<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StoreFactory extends Factory
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
            'logo' => $this->faker->imageUrl(300, 300),
            'cover' => $this->faker->imageUrl(800, 600),
        ];
    }
}
