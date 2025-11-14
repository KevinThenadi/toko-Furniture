<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel secara eksplisit
     */
    protected $table = 'kategori';

    /**
     * Atribut yang boleh diisi secara massal (mass assignable).
     * PENTING untuk Livewire.
     */
    protected $fillable = [
        'nama',
        'slug',
    ];

    /**
     * Relasi: Satu Kategori memiliki BANYAK Produk.
     */
    public function produk(): HasMany
    {
        // Relasi ke Model Produk, menggunakan foreign key 'kategori_id'
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}