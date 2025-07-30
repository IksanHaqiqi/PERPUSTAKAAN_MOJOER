<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'lemari_id',
        'peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

     public function lemari()
    {
        return $this->belongsTo(Lemari::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
