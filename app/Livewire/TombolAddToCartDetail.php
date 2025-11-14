<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;

class TombolAddToCartDetail extends Component
{
    public Produk $produk;
    public $kuantitas = 1; // Properti untuk menyimpan kuantitas

    public function mount(Produk $produk)
    {
        $this->produk = $produk;
    }

    // Method untuk menambah kuantitas
    public function increment()
    {
        $this->kuantitas++;
    }

    // Method untuk mengurangi kuantitas
    public function decrement()
    {
        if ($this->kuantitas > 1) {
            $this->kuantitas--;
        }
    }

    /**
     * Method ini dipanggil oleh tombol di DALAM modal
     */
    public function addToCart()
    {
        // Validasi sederhana
        if ($this->kuantitas < 1) {
            $this->kuantitas = 1;
        }

        // Kirim event dengan kuantitas yang sudah di-input
        $this->dispatch('tambah-ke-keranjang', 
            produkId: $this->produk->id,
            nama: $this->produk->nama,
            harga: $this->produk->harga,
            kuantitas: $this->kuantitas // <-- Kirim kuantitas dari state
        );
        
        $this->dispatch('info-keranjang', 'Produk ditambahkan ke keranjang!');

        // Reset kuantitas kembali ke 1 setelah ditambahkan
        $this->kuantitas = 1;
    }

    
    public function render()
    {
        // Arahkan ke file view blade baru
        return view('livewire.tombol-add-to-cart-detail');
    }
}