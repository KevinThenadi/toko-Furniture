<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;

class SearchModal extends Component
{
    public $cari = '';
    public $hasil = [];

    /**
     * Dijalankan setiap kali properti 'cari' diperbarui
     */
    public function updatedCari($value)
    {
        // Hanya cari jika input lebih dari 2 karakter
        if (strlen($value) >= 3) {
            $this->hasil = Produk::where('nama', 'like', '%' . $value . '%')
                                  ->orWhere('bahan', 'like', '%' . $value . '%')
                                  ->limit(5) // Batasi hasil agar tidak overload
                                  ->get();
        } else {
            $this->hasil = [];
        }
    }

    /**
     * Helper untuk membersihkan hasil & input
     * (Akan dipanggil dari view)
     */
    public function resetCari()
    {
        $this->cari = '';
        $this->hasil = [];
    }

    public function render()
    {
        // Kita tidak perlu query di sini,
        // karena 'updatedCari' sudah menangani
        return view('livewire.search-modal');
    }
}