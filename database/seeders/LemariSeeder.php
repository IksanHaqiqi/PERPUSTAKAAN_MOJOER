<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LemariSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Acak antara atomic dan black
            $imageName = fake()->randomElement([
                "atomic.jpg",
                "black.jpg",
                "teras.jpg",
            ]);

            DB::table('lemaris')->insert([
                'judul' => 'Buku ' . $i,
                'penerbit' => fake()->company(),
                'kategori' => fake()->randomElement(['Fiksi', 'Sains', 'Sejarah']),
                'stock' => fake()->numberBetween(5, 20),
                'image' => "storage/images/" . $imageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
