<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Produk;

class KeranjangIkon extends Component
{
    public $jumlahItem = 0;

    public function mount()
    {
        $this->hitungItem();
    }

    public function hitungItem()
    {
        $keranjang = session()->get('keranjang', []);
        // Hitung jumlah item unik, bukan total kuantitas
        $this->jumlahItem = count($keranjang); 
    }

    /**
     
     * Tambahkan parameter $kuantitas
     */
    #[On('tambah-ke-keranjang')] 
    public function terimaItemDariKatalog($produkId, $nama, $harga, $kuantitas = 1) // Tambahkan $kuantitas
    {
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$produkId])) {
            
            $keranjang[$produkId]['kuantitas'] += $kuantitas; 
        } else {
            $produk = Produk::find($produkId);
            $keranjang[$produkId] = [
                "nama" => $nama,
                "kuantitas" => $kuantitas, 
                "harga" => $harga,
                "gambar" => $produk ? $produk->gambar_utama : ''
            ];
        }
        
        session()->put('keranjang', $keranjang);
        $this->hitungItem(); // Update hitungan
    }

    // ... (render() method Anda tetap sama)
    public function render()
    {
        return <<<'HTML'
        <a href="{{ route('keranjang') }}" class="nav-link">
            <i class="bi bi-cart"></i>
            @if($jumlahItem > 0)
                <span class="badge bg-danger rounded-pill" style="font-size: 0.6em; position: relative; top: -8px; left: -5px;">
                    {{ $jumlahItem }}
                </span>
            @endif
        </a>
        HTML;
    }
}