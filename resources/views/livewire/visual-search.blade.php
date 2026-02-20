<div class="container py-5" style="min-height: 80vh;">
    
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-4">Cari Furniture dengan Gambar 📸</h2>
            
            <div class="card shadow-sm p-4 mb-5 border-0 bg-light">
                <div class="mb-3">
                    <label for="uploadFoto" class="form-label text-muted">Upload foto kursi/meja impianmu</label>
                    <input type="file" wire:model="photo" class="form-control" id="uploadFoto" accept="image/*">
                </div>

                <div wire:loading wire:target="photo" class="text-primary fw-bold mt-2">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    Sedang menganalisis gambar...
                </div>
                
                @if ($photo)
                    <div class="mt-3">
                        <span class="text-muted d-block mb-2">Gambar yang Anda upload:</span>
                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail rounded" style="height: 150px; object-fit: cover;">
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(!empty($results))
        <hr>
        <h4 class="fw-bold mb-4 mt-4">Produk Mirip Ditemukan:</h4>
        <div class="row g-4">
            @foreach($results as $item)
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/foto/' . $item['gambar_utama']) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-truncate">{{ $item['nama'] }}</h6>
                            <p class="text-primary fw-bold mb-1">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                            <small class="text-muted d-block mb-3">
                                <i class="bi bi-magic"></i> Kemiripan: {{ round($item['similarity'] * 100) }}%
                            </small>
                            <a href="{{ route('produk.show', $item['slug']) }}" class="btn btn-sm btn-dark w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(!$isSearching && $photo)
        <div wire:loading.remove wire:target="photo" class="alert alert-warning text-center mt-3">
            <i class="bi bi-exclamation-circle me-2"></i> 
            Maaf, tidak ditemukan produk yang mirip di database kami.
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    
</div>