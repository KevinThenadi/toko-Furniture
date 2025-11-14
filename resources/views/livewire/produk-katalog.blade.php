<div>
   
    @if($tampilkanFilter)
        <div class="filter-section d-flex justify-content-end mb-4">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    @if($slugKategoriAktif)
                        {{ $semuaKategori->firstWhere('slug', $slugKategoriAktif)->nama ?? 'Filter Aktif' }}
                    @else
                        Semua Kategori
                    @endif
                    
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#" 
                           wire:click.prevent="resetFilter">
                            Semua Kategori
                        </a>
                    </li>

                    @foreach ($semuaKategori as $kategori)
                        <li>
                            <a class="dropdown-item" href="#" 
                               wire:click.prevent="filter('{{ $kategori->slug }}')">
                                {{ $kategori->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <hr>
    @endif



    <!-- Bagian daftar produk ini akan selalu tampil -->
    <div class="row">
    @forelse ($semuaProduk as $produk)
        <div class="col-md-4 mb-3">
            <a href="{{ route('produk.show', $produk) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/foto/'. $produk->gambar_utama) }}" 
                         class="card-img-top" 
                         alt="{{ $produk->nama }}" 
                         style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $produk->nama }}</h5>
                        <p class="card-text text-muted">{{ $produk->dimensi }}</p>
                        <h6 class="text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12">
            <p class="text-center">Produk tidak ditemukan.</p>
        </div>
    @endforelse
</div>

    <div class="mt-4">
        @if(!$limit)
            {{ $semuaProduk->links() }}
        @endif
    </div>
</div>