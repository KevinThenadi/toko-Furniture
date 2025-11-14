<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk; 


class HalamanKeranjang extends Component
{
    // Properti untuk menyimpan data
    public $keranjang = [];
    public $total = 0;

    // Properti untuk Form (terhubung via wire:model)
    public $nama;
    public $no_hp;

    // Aturan validasi untuk form
    protected $rules = [
        'nama' => 'required|string|min:3',
        'no_hp' => 'required|string|min:9', // Minimal 9 digit untuk nomor HP
    ];

    /**
     * Dijalankan saat komponen dimuat pertama kali
     */
    public function mount()
    {
        $this->muatUlangKeranjang();
    }

    /**
     * [LISTENER]
     * Mendengarkan event 'tambah-ke-keranjang' yang dikirim
     * oleh komponen ProdukKatalog atau TombolAddToCartDetail
     */
    
   

    /**
     * Helper untuk mengambil data dari session dan hitung total
     */
    public function muatUlangKeranjang()
    {
        $this->keranjang = session()->get('keranjang', []);
        $this->hitungTotal();
    }

    /**
     * Helper untuk menghitung total harga
     */
    public function hitungTotal()
    {
        $this->total = 0;
        foreach ($this->keranjang as $item) {
            $this->total += $item['harga'] * $item['kuantitas'];
        }
    }

    // --- Interaksi di Halaman Keranjang ---

    public function tambahKuantitas($produkId)
    {
        if (isset($this->keranjang[$produkId])) {
            $this->keranjang[$produkId]['kuantitas']++;
            session()->put('keranjang', $this->keranjang);
            $this->muatUlangKeranjang();
        }
    }

    public function kurangiKuantitas($produkId)
    {
        if (isset($this->keranjang[$produkId])) {
            if ($this->keranjang[$produkId]['kuantitas'] > 1) {
                // Kurangi jika lebih dari 1
                $this->keranjang[$produkId]['kuantitas']--;
                session()->put('keranjang', $this->keranjang);
                $this->muatUlangKeranjang();
            } else {
                // Hapus jika 1 (atau kurang)
                $this->hapusItem($produkId);
            }
        }
    }

    public function hapusItem($produkId)
    {
        unset($this->keranjang[$produkId]);
        session()->put('keranjang', $this->keranjang);
        $this->muatUlangKeranjang();
        // Beri notifikasi (opsional, bisa ditangkap JS)
        $this->dispatch('info-keranjang', 'Item dihapus dari keranjang.');
    }

    // --- Proses Pesanan (Hanya WA) ---

    public function pesanSekarang()
    {
        // 1. Validasi form (hanya nama & no_hp)
        $dataValid = $this->validate();

        // 2. Buat URL WhatsApp
        $urlWhatsApp = $this->buatPesanWA($dataValid);

        // 3. Kosongkan keranjang di session (setelah sukses)
        session()->forget('keranjang');

        // 4. Redirect pengguna ke WhatsApp via JavaScript event
        $this->dispatch('redirect-ke', url: $urlWhatsApp);
    }

    private function buatPesanWA($data)
    {
        $adminWA = '6281331872285'; // <--  NOMOR WA ADMIN
        $pesan = "Halo Toko Furniture,\n\nSaya ingin memesan barang berikut:\n\n";
        
        foreach ($this->keranjang as $item) {
            $pesan .= "*{$item['nama']}*\n";
            $pesan .= "Kuantitas: {$item['kuantitas']}\n";
            $pesan .= "Subtotal: Rp " . number_format($item['harga'] * $item['kuantitas'], 0, ',', '.') . "\n\n";
        }
        $pesan .= "--------------------------\n";
        $pesan .= "Total Pesanan: *Rp " . number_format($this->total, 0, ',', '.') . "*\n\n";
        $pesan .= "Data Pemesan:\n";
        $pesan .= "Nama: *{$data['nama']}*\n";
        $pesan .= "No. HP: {$data['no_hp']}\n";

        return "https://wa.me/{$adminWA}?text=" . urlencode($pesan);
    }

    /**
     * Render view-nya
     */
    public function render()
    {
        // Ini akan memanggil file 'resources/views/livewire/halaman-keranjang.blade.php'
        return view('livewire.halaman-keranjang');
    }
}