<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => '3mmar',
            'email' => 'weeds0250@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01030122338',
        ]);
    }
}