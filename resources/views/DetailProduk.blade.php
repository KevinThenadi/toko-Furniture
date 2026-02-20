<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama }} | Toko Furniture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/produk.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body>

    <x-navbar />

    <section class="container py-5">
        <div class="row g-5">

            <div class="col-lg-6">
                <div id="carouselProduk" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/foto/' . $produk->gambar_utama) }}"
                                 class="d-block w-100 rounded shadow-sm img-zoom produk-img"
                                 alt="{{ $produk->nama }}"
                                 data-bs-toggle="modal"
                                 data-bs-target="#zoomModal"
                                 data-src="{{ asset('storage/foto/' . $produk->gambar_utama) }}">
                        </div>

                        @if($produk->galeri_gambar && count($produk->galeri_gambar) > 0)
                            @foreach($produk->galeri_gambar as $gambar)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/foto/' . $gambar) }}"
                                     class="d-block w-100 rounded shadow-sm img-zoom produk-img"
                                     alt="Galeri {{ $produk->nama }}"
                                     data-bs-toggle="modal"
                                     data-bs-target="#zoomModal"
                                     data-src="{{ asset('storage/foto/' . $gambar) }}">
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduk" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProduk" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>

                @if($produk->galeri_gambar && count($produk->galeri_gambar) > 0)
                <div class="row g-2 mt-3">
                    <div class="col-3">
                        <img src="{{ asset('storage/foto/' . $produk->gambar_utama) }}"
                             class="img-fluid rounded shadow-sm"
                             alt="Gambar utama"
                             data-bs-target="#carouselProduk"
                             data-bs-slide-to="0"
                             style="cursor:pointer;">
                    </div>
                    @foreach($produk->galeri_gambar as $key => $gambar)
                    <div class="col-3">
                        <img src="{{ asset('storage/foto/' . $gambar) }}"
                             class="img-fluid rounded shadow-sm"
                             alt="Galeri produk"
                             data-bs-target="#carouselProduk"
                             data-bs-slide-to="{{ $key + 1 }}"
                             style="cursor:pointer;">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="col-lg-6">
                @if($produk->kategori)
                    <h6 class="text-secondary mb-2">{{ $produk->kategori->nama }}</h6>
                @endif
                
                <h1 class="fw-bold display-5">{{ $produk->nama }}</h1>

                <div class="mb-3">
                    @if(isset($produk->harga_sebelum_diskon) && $produk->harga_sebelum_diskon > 0)
                        <s class="text-muted fs-4">Rp {{ number_format($produk->harga_sebelum_diskon, 0, ',', '.') }}</s>
                        <h2 class="text-danger fw-bold">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            <span class="badge bg-danger fs-6 align-middle">DISKON</span>
                        </h2>
                    @else
                        <h2 class="text-primary fw-bold">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </h2>
                    @endif
                </div>

                <p class="fs-5 mb-4">{{ $produk->deskripsi }}</p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item px-0"><strong>Dimensi:</strong> {{ $produk->dimensi }}</li>
                    <li class="list-group-item px-0"><strong>Bahan:</strong> {{ $produk->bahan }}</li>
                    <li class="list-group-item px-0"><strong>Stok:</strong> {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}</li>
                </ul>

                <livewire:tombol-add-to-cart-detail :produk="$produk" />
            </div>
        </div>

        <div class="mt-5 pt-4">
            <livewire:rekomendasi-produk :kategoriId="$produk->kategori_id" />
        </div>

    </section>

    <div class="modal fade" id="zoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <img id="zoomImage" src="" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Event untuk menampilkan gambar dalam modal zoom
        document.querySelectorAll('.img-zoom').forEach(img => {
            img.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                document.getElementById('zoomImage').src = src;
            });
        });
    </script>

    @livewireScripts
</body>
</html>