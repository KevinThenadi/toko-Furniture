<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk/{produk:slug}', [ProdukController::class, 'show'])
     ->name('produk.show'); 


Route::get('/produk', function () {
    return view('produk'); 
})->name('produk.index');


Route::get('/tentang', function () {
    
    $kategoriData = Kategori::withCount('produk')->get();

    
    // ->pluck() adalah helper Laravel untuk mengambil satu kolom
    $labels = $kategoriData->pluck('nama'); // -> ['Kursi', 'Meja', 'Lemari']
    $data = $kategoriData->pluck('produk_count'); 

    
    return view('tentang', [
        'labels' => $labels,
        'data' => $data
    ]);
})->name('tentang');

Route::get('/kontak', function () {
    return view('kontak'); 
});

Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');

Route::get('/privasi', function () {
    return view('privasi');
})->name('privasi');

Route::get('/syarat', function () {
    return view('syarat');
})->name('syarat');