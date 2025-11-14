<?php

namespace App\Livewire;

use App\Models\Kategori;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class ProdukKatalog extends Component
{
    use WithPagination;

    public $slugKategoriAktif = null;
    public $tampilkanFilter = true;
    public $limit = null;

    public function mount($tampilkanFilter = true, $limit = null)
    {
        $this->tampilkanFilter = $tampilkanFilter;
        $this->limit = $limit;
    }

    public function filter($slug)
    {
        $this->slugKategoriAktif = $slug;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->slugKategoriAktif = null;
        $this->resetPage();
    }

    /**
     * [BARU] Method untuk menambah produk ke keranjang (session)
     * Method ini akan "berteriak" (dispatch event)
     */
    public function tambahKeKeranjang($produkId, $nama, $harga)
    {
        // Kirim event yang akan didengar oleh 'KeranjangIkon'
        // Kita kirim 4 parameter, termasuk kuantitas
        $this->dispatch('tambah-ke-keranjang', 
            produkId: $produkId,
            nama: $nama,
            harga: $harga,
            kuantitas: 1  // <-- Kirim '1' sebagai kuantitas default
        );
        
        // Kirim notifikasi 
        $this->dispatch('info-keranjang', 'Produk ditambahkan ke keranjang!');
    }


    /**
     * Method render() adalah inti dari Livewire.
     */
    public function render()
    {
        $semuaKategori = Kategori::all();

        $queryProduk = Produk::query();

        $queryProduk->when($this->slugKategoriAktif, function ($query) {
            $query->whereHas('kategori', function ($q) {
                $q->where('slug', $this->slugKategoriAktif);
            });
        });
        
        // Ganti logika get() dan limit() dengan paginate()
        if ($this->limit) {
            // Jika ada limit (misal di beranda), ambil sejumlah itu
            $semuaProduk = $queryProduk->latest()->limit($this->limit)->get();
        } else {
            // Jika tidak ada limit (di halaman produk), gunakan pagination
            $semuaProduk = $queryProduk->latest()->paginate(9); // Ubah 9 sesuai kebutuhan
        }

        return view('livewire.produk-katalog', [
            'semuaKategori' => $semuaKategori,
            'semuaProduk' => $semuaProduk,
        ]);
    }
}