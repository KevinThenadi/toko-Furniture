<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // 1. Ambil ID Kategori secara dinamis
        $kategoriKursi = Kategori::where('slug', 'kursi')->first();
        $kategoriMeja = Kategori::where('slug', 'meja')->first();
        $kategoriLemari = Kategori::where('slug', 'lemari')->first();

        // 2. Cek apakah kategori ada
        if (!$kategoriKursi || !$kategoriMeja || !$kategoriLemari) {
            $this->command->error('Kategori (Kursi, Meja, Lemari) tidak ditemukan.');
            $this->command->info('Pastikan Anda sudah menjalankan KategoriSeeder terlebih dahulu.');
            return;
        }

        

        // --- PRODUK 1 (Meja 1) ---
        $namaProduk1 = 'Meja Makan Kayu Solid';
        Produk::create([
            'kategori_id' => $kategoriMeja->id,
            'nama' => $namaProduk1,
            'slug' => Str::slug($namaProduk1),
            'deskripsi' => 'Meja makan elegan terbuat dari kayu solid, cocok untuk 4-6 orang.',
            'harga' => 4500000.00,
            'dimensi' => 'P: 160cm, L: 80cm, T: 75cm',
            'bahan' => 'Kayu Solid, Finishing Natural',
            'stok' => 12,
            'gambar_utama' => 'meja1.jpeg',
            'galeri_gambar' => [
                'GaleriMeja1A.jpeg', 'GaleriMeja1B.jpeg', 'GaleriMeja1C.jpeg',
            ]
        ]);

        // --- PRODUK 2 (Kursi 1) ---
        $namaProduk2 = 'Kursi Berlengan Modern (Abu-abu)';
        Produk::create([
            'kategori_id' => $kategoriKursi->id,
            'nama' => $namaProduk2,
            'slug' => Str::slug($namaProduk2),
            'deskripsi' => 'Kursi nyaman dengan dudukan empuk dan kaki kayu solid.',
            'harga' => 950000.00,
            'dimensi' => 'P: 50cm, L: 55cm, T: 82cm',
            'bahan' => 'Kain, Busa, Kaki Kayu Solid',
            'stok' => 45,
            'gambar_utama' => 'kursi1.jpeg',
            'galeri_gambar' => [
                'GaleriKursi1A.jpeg', 'GaleriKursi1B.jpeg', 'GaleriKursi1C.jpeg',
            ]
        ]);

        // --- PRODUK 3 (Lemari 1) ---
        $namaProduk3 = 'Lemari Pakaian 2 Pintu Kayu';
        Produk::create([
            'kategori_id' => $kategoriLemari->id,
            'nama' => $namaProduk3,
            'slug' => Str::slug($namaProduk3),
            'deskripsi' => 'Lemari pakaian 2 pintu dengan desain modern.',
            'harga' => 5800000.00,
            'dimensi' => 'P: 100cm, L: 60cm, T: 200cm',
            'bahan' => 'Plywood, Veneer Kayu',
            'stok' => 8,
            'gambar_utama' => 'lemari1.jpeg',
            'galeri_gambar' => [
                'GaleriLemari1A.jpeg', 'GaleriLemari1B.jpeg', 'GaleriLemari1C.jpeg',
            ]
        ]);

       

        // --- PRODUK 4 (Kursi 2) ---
        $namaProduk4 = 'Kursi Kayu Jati Bantal Abu';
        Produk::create([
            'kategori_id' => $kategoriKursi->id,
            'nama' => $namaProduk4,
            'slug' => Str::slug($namaProduk4),
            'deskripsi' => 'Kursi makan elegan dengan rangka kayu jati melengkung dan bantal abu yang nyaman.',
            'harga' => 1100000.00,
            'dimensi' => 'P: 55cm, L: 60cm, T: 80cm',
            'bahan' => 'Kayu Jati, Kain Linen, Busa',
            'stok' => 30,
            'gambar_utama' => 'kursi2.jpeg',
            'galeri_gambar' => [
                'GaleriKursi2A.jpeg',
            ]
        ]);

        // --- PRODUK 5 (Kursi 3) ---
        $namaProduk5 = 'Kursi Santai Mid-Century Tufted';
        Produk::create([
            'kategori_id' => $kategoriKursi->id,
            'nama' => $namaProduk5,
            'slug' => Str::slug($namaProduk5),
            'deskripsi' => 'Kursi santai bergaya mid-century dengan kancing tufted dan rangka kayu gelap yang kokoh.',
            'harga' => 1750000.00,
            'dimensi' => 'P: 65cm, L: 70cm, T: 85cm',
            'bahan' => 'Kain Woven, Kancing, Rangka Kayu Solid',
            'stok' => 15,
            'gambar_utama' => 'kursi3.jpeg',
            'galeri_gambar' => [
                'GaleriKursi3A.jpeg',
            ]
        ]);

        // --- PRODUK 6 (Meja 2) ---
        $namaProduk6 = 'Meja Kerja Kayu Oak Ramping';
        Produk::create([
            'kategori_id' => $kategoriMeja->id,
            'nama' => $namaProduk6,
            'slug' => Str::slug($namaProduk6),
            'deskripsi' => 'Meja kerja atau meja makan kecil dengan desain minimalis dan kaki ramping. Terbuat dari kayu oak cerah.',
            'harga' => 2100000.00,
            'dimensi' => 'P: 120cm, L: 60cm, T: 75cm',
            'bahan' => 'Kayu Oak Solid',
            'stok' => 20,
            'gambar_utama' => 'meja3.jpeg',
            'galeri_gambar' => [
                'GaleriMeja3A.jpeg',
            ]
        ]);

        // --- PRODUK 7 (Meja 3) ---
        $namaProduk7 = 'Meja Makan Rustic Kaki Tebal';
        Produk::create([
            'kategori_id' => $kategoriMeja->id,
            'nama' => $namaProduk7,
            'slug' => Str::slug($namaProduk7),
            'deskripsi' => 'Meja makan besar bergaya rustic dengan top table tebal dan kaki balok yang kokoh. Cocok untuk ruang makan keluarga.',
            'harga' => 6200000.00,
            'dimensi' => 'P: 180cm, L: 90cm, T: 76cm',
            'bahan' => 'Kayu Solid Rustic',
            'stok' => 7,
            'gambar_utama' => 'meja2.jpeg',
            'galeri_gambar' => [
                'GaleriMeja2A.jpeg',
            ]
        ]);

        // --- PRODUK 8 (Lemari 2) ---
        $namaProduk8 = 'Lemari Pakaian Handle Hitam Panjang';
        Produk::create([
            'kategori_id' => $kategoriLemari->id,
            'nama' => $namaProduk8,
            'slug' => Str::slug($namaProduk8),
            'deskripsi' => 'Lemari 2 pintu modern dengan veneer kayu oak dan handle vertikal hitam yang kontras.',
            'harga' => 6100000.00,
            'dimensi' => 'P: 100cm, L: 60cm, T: 200cm',
            'bahan' => 'Plywood, Veneer Kayu Oak, Handle Metal',
            'stok' => 11,
            'gambar_utama' => 'lemari3.jpeg',
            'galeri_gambar' => [
                'GaleriLemari3A.jpeg',
            ]
        ]);

        // --- PRODUK 9 (Lemari 3) ---
        $namaProduk9 = 'Lemari Kayu Handle Coklat';
        Produk::create([
            'kategori_id' => $kategoriLemari->id,
            'nama' => $namaProduk9,
            'slug' => Str::slug($namaProduk9),
            'deskripsi' => 'Lemari 2 pintu fungsional dengan finishing kayu cerah dan handle kayu senada. Cocok untuk kamar tidur.',
            'harga' => 5500000.00,
            'dimensi' => 'P: 90cm, L: 55cm, T: 190cm',
            'bahan' => 'Plywood, Veneer Kayu',
            'stok' => 14,
            'gambar_utama' => 'lemari2.jpeg',
            'galeri_gambar' => [
                'GaleriLemari2A.jpeg',
            ]
        ]);
    }
}