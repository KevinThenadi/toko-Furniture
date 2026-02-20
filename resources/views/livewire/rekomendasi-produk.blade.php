<div>
    @if(!empty($produkRekomendasi))
        <hr class="my-5">
        
        <h3 class="fw-bold mb-4">Rekomendasi Pilihan AI</h3>
        
        <div class="row">
            @foreach($produkRekomendasi as $item)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/foto/' . $item['gambar_utama']) }}" 
                             class="card-img-top" 
                             alt="{{ $item['nama'] }}"
                             style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $item['nama'] }}</h5>
                            <p class="text-primary fw-bold mb-3">
                                Rp {{ number_format($item['harga'], 0, ',', '.') }}
                            </p>
                            
                            <a href="{{ route('produk.show', $item['slug']) }}" class="btn btn-outline-dark w-100 stretched-link">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>