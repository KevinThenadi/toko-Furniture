<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel secara eksplisit
     */
    protected $table = 'produk';

    /**
     * Atribut yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'dimensi',
        'bahan',
        'stok',
        'gambar_utama',
        'galeri_gambar',
    ];

    /**
     * Casts atribut
     * Mengubah 'galeri_gambar' (JSON) menjadi 'array' PHP secara otomatis.
     */
    protected $casts = [
        'galeri_gambar' => 'array',
        'harga' => 'decimal:2', // Pastikan harga dibaca sebagai desimal
    ];

    /**
     * Relasi: Satu Produk dimiliki oleh SATU Kategori.
     */
    public function kategori(): BelongsTo
    {
        // Relasi ke Model Kategori, menggunakan foreign key 'kategori_id'
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}