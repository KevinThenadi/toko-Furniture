<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Untuk membuat slug
use App\Models\Kategori;     // Gunakan Model

class KategoriSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // Hapus data lama di tabel kategori
       // Kategori::truncate();

        // Data yang ingin Anda masukkan
        $kategori = [
            'Kursi',
            'Meja',
            'Lemari', // Mengganti 'Lemari Penyimpanan'
            // 'Sofa' dihapus
        ];

        // Loop dan masukkan data menggunakan Model
        foreach ($kategori as $nama) {
            Kategori::create([
                'nama' => $nama,
                'slug' => Str::slug($nama) // Otomatis membuat: 'kursi', 'meja', 'lemari'
            ]);
        }
    }
}