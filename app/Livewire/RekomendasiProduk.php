<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RekomendasiProduk extends Component
{
    public $produkRekomendasi = [];
    public $kategoriId;

    public function mount($kategoriId)
    {
        $this->kategoriId = $kategoriId;
        $this->ambilDataDariFastAPI();
    }

    public function ambilDataDariFastAPI()
    {
        try {
            // Pastikan port 8001 sesuai dengan terminal Python Anda
            $response = Http::timeout(2)->get('http://127.0.0.1:8001/rekomendasi/' . $this->kategoriId);

            if ($response->successful()) {
                $this->produkRekomendasi = $response->json()['data'];
            }
        } catch (\Exception $e) {
            $this->produkRekomendasi = [];
        }
    }

    public function render()
    {
        return view('livewire.rekomendasi-produk');
    }
}