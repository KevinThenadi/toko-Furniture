<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// TAMBAHKAN INI
use Illuminate\Support\Facades\Schema;
use App\Models\Kategori;
use App\Models\Produk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed aplikasi database Anda.
     */
    public function run(): void
    {
        // 1. Nonaktifkan Cek Foreign Key
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel (URUTAN PENTING: anak dulu, baru induk)
        Produk::truncate();
        Kategori::truncate();

        // 3. Aktifkan lagi Cek Foreign Key
        Schema::enableForeignKeyConstraints();

        // 4. Jalankan seeder untuk mengisi data
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class, // Pastikan Anda juga punya seeder produk
        ]);
    }
}