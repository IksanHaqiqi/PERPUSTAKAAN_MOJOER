<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lemari extends Model
{
    protected $table = 'lemaris';
    protected $fillable = ['judul', 'penerbit', 'kategori', 'stock','image'];

     public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

}
