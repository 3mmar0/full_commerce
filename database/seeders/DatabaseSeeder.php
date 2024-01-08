<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Admin::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'wedds0250@gmail.com',
        // ]);

        // Store::factory(1)->create();
        // Category::factory(1)->create();
        // Product::factory(1)->create();

        $this->call(UserSeeder::class);
    }
}
