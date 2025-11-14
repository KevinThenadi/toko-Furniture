<!DOCTYPE html>
<html lang="id">

<head>
    <title>Tentang Kami | Toko Furniture</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap">
    @livewireStyles
</head>

<body>

    <!-- Header -->
    <x-navbar />

    <!-- Hero Section -->
    <header class="tentang-hero text-center d-flex align-items-center justify-content-center">
        <div class="overlay"></div>
        <div class="container position-relative text-white">
            <h1 class="display-4 fw-bold">Tentang Kami</h1>
            <p class="lead">Mewujudkan rumah impian Anda dengan furniture terbaik dan desain modern</p>
        </div>
    </header>

    <!-- Content Section -->
    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h2 class="fw-bold mb-4">Tentang Toko Furniture</h2>
                <p><strong>Toko Furniture</strong> adalah penyedia produk furnitur berkualitas tinggi dengan desain modern
                    dan elegan. Kami hadir untuk membantu Anda menciptakan ruang hunian yang nyaman, estetik, dan fungsional.</p>
                <p>Sejak awal berdiri, kami berkomitmen untuk memberikan layanan terbaik dengan produk yang tidak hanya
                    indah dipandang, tetapi juga tahan lama. Setiap item dipilih dengan cermat untuk memastikan kepuasan
                    dan kenyamanan pelanggan kami.</p>
                <p>Kami percaya bahwa <strong>setiap rumah memiliki cerita</strong>, dan kami ingin menjadi bagian dari cerita Anda —
                    menghadirkan kehangatan melalui setiap sentuhan desain furniture kami.</p>
            </div>
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <div style="width: 100%; max-width: 400px; max-height: 400px;">
                    <canvas id="produkChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Visi & Misi Kami</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <i class="bi bi-eye display-5 text-warning mb-3"></i>
                        <h5 class="fw-bold">Visi</h5>
                        <p>Mewujudkan toko furniture terdepan yang menghadirkan keindahan dan kenyamanan di setiap rumah
                            Indonesia.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <i class="bi bi-bullseye display-5 text-warning mb-3"></i>
                        <h5 class="fw-bold">Misi</h5>
                        <ul class="list-unstyled text-start mx-auto" style="max-width: 400px;">
                            <li>• Menyediakan produk furniture dengan kualitas terbaik.</li>
                            <li>• Mengutamakan pelayanan pelanggan yang ramah dan profesional.</li>
                            <li>• Menghadirkan desain yang modern, fungsional, dan berkelanjutan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Toko -->
    <section class="container py-5">
        <h2 class="fw-bold text-center mb-5">Galeri Toko Kami</h2>
        <div class="row g-4">
            <div class="col-md-4 col-sm-6">
                <div class="custom-box">
                    <img src="{{ asset('storage/foto/galeri1.png') }}" alt="Toko 1" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="custom-box">
                    <img src="{{ asset('storage/foto/galeri2.png') }}" alt="Toko 2" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="custom-box">
                    <img src="{{ asset('storage/foto/galeri3.png') }}" alt="Toko 3" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen <canvas>
        const ctx = document.getElementById('produkChart').getContext('2d');
        
        // Ambil data yang DIKIRIM DARI ROUTE/CONTROLLER
        const labels = @json($labels);
        const data = @json($data);

        //  Fungsi untuk membuat warna HSL random yang bagus
        function generateRandomHSLColor() {
            const hue = Math.floor(Math.random() * 360); // 0-360 derajat (warna pelangi)
            const saturation = '70%'; // 70% agar warna tidak terlalu pudar atau neon
            const lightness = '50%'; // 50% agar warna pas (tidak terlalu gelap/terang)
            return `hsl(${hue}, ${saturation}, ${lightness})`;
        }

        //  Buat array warna dinamis
        const dynamicColors = [];
        for (let i = 0; i < data.length; i++) {
            dynamicColors.push(generateRandomHSLColor());
        }

        // Buat diagram baru
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Produk',
                    data: data,
                    
                    //Gunakan array dinamis 
                    backgroundColor: dynamicColors, 
                    
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Produk Toko Furniture',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    });
</script>
</body>

</html>
