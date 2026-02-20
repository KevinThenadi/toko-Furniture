<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Wajib untuk upload
use Illuminate\Support\Facades\Http;

class VisualSearch extends Component
{
    use WithFileUploads;

    public $photo; // Menyimpan file upload sementara
    public $results = [];
    public $isSearching = false;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048', // Validasi maks 2MB
        ]);

        $this->cariGambar();
    }

    public function cariGambar()
    {
        $this->isSearching = true;
        $this->results = [];

        try {
            // Kirim file ke FastAPI menggunakan Http Client Laravel
            // 'file' adalah nama field yang diminta FastAPI
            $response = Http::attach(
                'file', file_get_contents($this->photo->getRealPath()), $this->photo->getClientOriginalName()
            )->post('http://127.0.0.1:8001/visual-search');

            if ($response->successful()) {
                $this->results = $response->json()['data'];
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghubungi AI Server.');
        }

        $this->isSearching = false;
    }

    public function render()
    {
        return view('livewire.visual-search');
    }
}