<!DOCTYPE html>
<html lang="id">

<head>
    <title>Kontak Kami | Toko Furniture</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap">

    <style>
        /* Hero Section */
        header.masthead {
            background: url('{{ asset('storage/carousel/3.jpg') }}') center/cover no-repeat;
            height: 50vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        header.masthead::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        header.masthead .container {
            position: relative;
            z-index: 2;
        }

        .contact-info i {
        
            margin-right: 10px;
        }

        .contact-info a.btn {
            margin-right: 10px;
        }

        .map-responsive {
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .map-responsive iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .contact-form {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        

       

        @media (max-width: 768px) {
            header.masthead {
                height: 35vh;
            }

            .map-responsive iframe {
                height: 300px;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <x-navbar />

    <!-- Hero Section -->
    <header class="masthead text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Hubungi Kami</h1>
            <p class="lead">Kami siap membantu Anda menemukan furniture impian Anda</p>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="container py-5">
        <div class="row g-4">
            <!-- Info Kontak -->
            <div class="col-md-6">
                <div class="contact-info">
                    <h2 class="fw-bold mb-3">Info Kontak</h2>
                    <p>Kami senang mendengar dari Anda! Silakan hubungi kami melalui kontak berikut.</p>
                    <p><i class="bi bi-whatsapp"></i> +62 81331872285</p>
                    <p><i class="bi bi-telephone"></i> (031) 567-1234</p>
                    <p><i class="bi bi-envelope"></i> support@tokofurniture.id</p>
                    <p><i class="bi bi-geo-alt"></i> Jl. Merbau Indah No. 45, Surabaya, Jawa Timur</p>

                    <a href="https://wa.me/6281331872285" class="btn btn-success">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                    <a href="tel:+62315671234" class="btn btn-warning text-white">
                        <i class="bi bi-telephone"></i> Telepon
                    </a>
                </div>
            </div>

          
        <!-- Map -->
        <div class="mt-5">
            <h3 class="fw-bold text-center mb-4">Lokasi Kami</h3>
            <div class="map-responsive">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.484014314273!2d112.72712617465742!3d-7.948116879048386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7dd7b61f0a9f5%3A0x2d12e8303ff7c7da!2sSurabaya!5e0!3m2!1sid!2sid!4v1692115555359!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
