<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Furniture | Selamat Datang</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Style CSS -->
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/produk.css') }}" rel="stylesheet">
        

    <!-- Bootstrap CSS -->

</head>

<body>

    <!-- Navbar -->
       <x-navbar />

   
   <!-- Hero Section (Carousel) -->
<section class="hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/carousel/1.png') }}" class="d-block w-100 hero-img" alt="Hero Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h1  class="text-white">Hadirkan Gaya & Kenyamanan di Rumah Anda</h1>
                    <p  class="text-white">Temukan koleksi furniture kontemporer dengan desain unik dan fungsional.</p>
                    <a href="#produk" class="btn btn-utama mt-3">Jelajahi Produk</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('storage/carousel/2.jpg') }}" class="d-block w-100 hero-img" alt="Hero Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="text-white">Furniture Minimalis, Desain Elegan</h1>
                    <p class="text-white">Lengkapi ruanganmu dengan produk yang stylish dan nyaman.</p>
                    <a href="#produk" class="btn btn-utama mt-3">Lihat Koleksi</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('storage/carousel/3.jpg') }}" class="d-block w-100 hero-img" alt="Hero Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="text-white">Inspirasi Interior Terbaik</h1>
                    <p class="text-white">Buat rumahmu lebih hidup dengan sentuhan desain modern.</p>
                    <a href="#produk" class="btn btn-utama mt-3">Temukan Sekarang</a>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sebelumnya</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Berikutnya</span>
        </button>
    </div>
</section>


    <!-- Produk -->
    <section id="produk" class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Produk Terbaru</h2>
            <p>Temukan koleksi terbaik kami yang sedang tren tahun ini.</p>
        </div>

        <livewire:produk-katalog :tampilkanFilter="false" :limit="3" />
            

            
            
    </section>

   @if(isset($produk))
    <div class="mt-5">
        <livewire:rekomendasi-produk :kategoriId="$produk->kategori_id" />
    </div>
    @endif


    <livewire:chatbot-floating />

    @livewireScripts
    <!-- Footer -->
    <x-footer />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
