<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel 'kategori'
            $table->foreignId('kategori_id')
                  ->constrained('kategori') // merujuk ke tabel 'kategori'
                  ->onDelete('cascade');

            $table->string('nama'); // Nama produk
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            
            $table->decimal('harga', 12, 2); // Harga (misal: 12.500.000,00)
            $table->string('dimensi', 100)->nullable(); // Dimensi (P: 100cm, L: 80cm)
            $table->string('bahan', 255)->nullable(); // Bahan (Kayu Jati, Kain Velvet)
            
            $table->integer('stok')->default(0);
            
            $table->string('gambar_utama'); // Nama file gambar utama
            
            // Menyimpan galeri sebagai JSON array
            $table->json('galeri_gambar')->nullable(); 
            
            $table->timestamps(); 
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};