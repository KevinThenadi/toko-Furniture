<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk | Toko Furniture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/produk.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body>

    <!-- Navbar -->
    <x-navbar />

  

    <!-- Konten Produk -->
    <section class="container py-5">

        <!-- Header Produk -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold mb-0">Daftar Produk</h2>
            <h4 class="text-end mb-0 text-secondary">Semua Produk Kami</h4>
        </div>

        <!-- Komponen Livewire (jika digunakan) -->
        <livewire:produk-katalog :tampilkanFilter="true" />

       

    </section>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @livewireStyles
</body>
</html>
