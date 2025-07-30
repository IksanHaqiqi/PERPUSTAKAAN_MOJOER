<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('peminjamans')->insert([
                'user_id' => fake()->numberBetween(1, 5), // ID user, pastikan user sudah ada
                'lemari_id' => fake()->numberBetween(1, 10), // ID buku, pastikan buku sudah ada
                'tanggal_pinjam' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'tanggal_kembali' => fake()->dateTimeBetween('now', '+14 days')->format('Y-m-d'),
                'status' => fake()->randomElement(['menunggu', 'disetujui', 'ditolak']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
