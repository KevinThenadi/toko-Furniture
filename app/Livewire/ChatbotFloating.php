<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChatbotFloating extends Component
{
    public $isOpen = false; // Status chatbox (buka/tutup)
    public $inputPesan = '';
    public $riwayatChat = []; // Menyimpan percakapan [ ['role' => 'user', 'msg' => 'Halo'], ... ]
    public $isTyping = false; // Indikator loading

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function kirimPesan()
    {
        // Validasi input tidak boleh kosong
        if (trim($this->inputPesan) === '') return;

        // 1. Masukkan pesan user ke riwayat (agar langsung muncul di layar)
        $this->riwayatChat[] = ['role' => 'user', 'msg' => $this->inputPesan];
        $pesanUser = $this->inputPesan; // Simpan ke variabel sementara
        $this->inputPesan = ''; // Kosongkan input form
        $this->isTyping = true; // Munculkan status "Sedang mengetik..."


        // 2. Kirim ke Python FastAPI
        try {
            $response = Http::timeout(60)->post('http://127.0.0.1:8001/chat', [
                'pesan' => $pesanUser
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // [PERBAIKAN DISINI]
                // Cek apakah Python mengirim 'jawaban' atau 'error'
                if (isset($data['jawaban'])) {
                    $jawabanBot = $data['jawaban'];
                } elseif (isset($data['error'])) {
                    $jawabanBot = "⚠️ Info AI: " . $data['error'];
                } else {
                    $jawabanBot = "⚠️ Respon server tidak dikenali.";
                }
            } else {
                $jawabanBot = "Maaf, server AI sedang sibuk (Status: " . $response->status() . ")";
            }

        } catch (\Exception $e) {
            $jawabanBot = "Gagal terhubung ke AI: " . $e->getMessage();
        }

        // ... (kode bawah tetap sama)

        // 3. Masukkan balasan bot ke riwayat
        $this->riwayatChat[] = ['role' => 'bot', 'msg' => $jawabanBot];
        $this->isTyping = false;
    }

    public function render()
    {
        return view('livewire.chatbot-floating');
    }
}