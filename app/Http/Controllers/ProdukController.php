<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
  
    public function index()
    {
        $semuaProduk = Produk::latest()->get();
        return view('produk', [
            'semuaProduk' => $semuaProduk
        ]);
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     */
    public function show(Produk $produk)
    {
        
        return view('Detailproduk', [
            'produk' => $produk
        ]);
    }
}