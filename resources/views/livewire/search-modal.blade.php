<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" 
     wire:ignore.self> <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Cari Produk</h5>
                <button wire:click="resetCari" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <input 
                    wire:model.live.debounce.300ms="cari" 
                    type="text" 
                    class="form-control form-control-lg" 
                    placeholder="Ketik nama atau bahan furnitur..."
                    autofocus>

                <div wire:loading wire:target="cari" class="text-center p-3">
                    <span class="spinner-border spinner-border-sm" role="status"></span>
                    Mencari...
                </div>

                @if(!empty($hasil) && !$errors->any())
                <hr>
                <p class="text-muted">Hasil pencarian untuk: "{{ $cari }}"</p>
                <ul class="list-group list-group-flush">
                    @forelse($hasil as $produk)
                        <li class="list-group-item">
                            <a href="{{ route('produk.show', $produk) }}" class="text-decoration-none text-dark d-flex align-items-center">
                                <img src="{{ asset('storage/foto/' . $produk->gambar_utama) }}" alt="{{ $produk->nama }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $produk->nama }}</h6>
                                    <span class="price-normal">{{ number_format($produk->harga, 0, ',', '.') }}</span>
                                </div>
                            </a>
                        </li>
                    @empty
                        @endforelse
                </ul>
                @elseif(strlen($cari) >= 3)
                    <p class="p-3 text-center">Tidak ada hasil ditemukan untuk "{{ $cari }}".</p>
                @endif

            </div>
        </div>
    </div>
</div>