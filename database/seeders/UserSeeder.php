<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run()
{
    for ($i = 1; $i <= 10; $i++) {
        DB::table('users')->insert([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'), // default password
            'role' => fake()->randomElement(['user']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}
