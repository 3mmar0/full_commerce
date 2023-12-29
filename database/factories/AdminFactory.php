<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => '3mmar',
            'username' => '3mmar',
            'email' => 'ammarelgndy6@gmail.com',
            'phone' => '01030122338',
            'super-admin' => true,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
