<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http; // [PENTING] Import Library HTTP Client

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
            
            // --- LOGIKA LAMA (ELOQUENT) DIHAPUS ---
            /* $this->hasil = Produk::where(...) ->get(); 
            */

            // --- LOGIKA BARU (INTEGRASI FAST API) ---
            try {
                // 1. Tembak endpoint Python di port 8001
                // Kita kirim parameter 'q' sesuai yang diminta main.py
                $response = Http::timeout(5)->get('http://127.0.0.1:8001/search', [
                    'q' => $value
                ]);

                // 2. Cek jika request berhasil (Status 200 OK)
                if ($response->successful()) {
                    // Ambil key 'data' dari respon JSON Python
                    // Struktur JSON Python: { "data": [ ... ] }
                    $this->hasil = $response->json()['data'];
                } else {
                    $this->hasil = [];
                }

            } catch (\Exception $e) {
                // Fallback: Jika server Python mati, kosongkan hasil agar tidak error
                // Opsional: Anda bisa log errornya dengan Log::error($e->getMessage());
                $this->hasil = [];
            }

        } else {
            // Jika input dihapus atau < 3 karakter, kosongkan hasil
            $this->hasil = [];
        }
    }

    /**
     * Helper untuk membersihkan hasil & input
     */
    public function resetCari()
    {
        $this->cari = '';
        $this->hasil = [];
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}