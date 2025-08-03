<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'penulis',
        'tanggal_publish',
        'views',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];
}
