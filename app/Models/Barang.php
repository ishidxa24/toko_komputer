<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Beri tahu Laravel bahwa nama tabelnya adalah 'barang' (bukan 'barangs')
    protected $table = 'barang';

    // Sesuaikan fillable dengan kolom di migration kamu
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'stock',
        'satuan',
    ];

    // Relasi ke tabel Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
