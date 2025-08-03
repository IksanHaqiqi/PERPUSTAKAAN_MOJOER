<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $judulList = [
            'Teknologi AI Semakin Canggih di Tahun 2025',
            'Laravel 10 Rilis Fitur Autentikasi Baru',
            'Tips Belajar Pemrograman Untuk Pemula',
            'Pentingnya Cybersecurity di Era Digital',
            'Perkembangan Startup di Indonesia',
            'Mengenal Framework Tailwind CSS',
            'Cara Membuat Blog Dengan Laravel',
            'Perbandingan PHP dan JavaScript',
            'Tren Desain Web Modern',
            'Mengelola Proyek dengan Git dan GitHub'
        ];

        foreach ($judulList as $judul) {
            Berita::create([
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'isi' => 'Ini adalah isi dummy untuk berita berjudul "' . $judul . '". Paragraf ini bisa kamu ganti sesuai kebutuhan.',
                'gambar' => 'hakiki.jpg', 
                'penulis' => 'Admin',
                'tanggal_publish' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
