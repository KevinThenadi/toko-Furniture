<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Keranjang Belanja | Toko Furniture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    @livewireStyles
</head>
<body>

    <x-navbar />

    <div class="container mt-5 pt-4">
    <livewire:halaman-keranjang />
    </div>


    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @livewireScripts

    <script>
        document.addEventListener('livewire:initialized', () => {
            // "Mendengarkan" event 'redirect-ke' dari Livewire
            Livewire.on('redirect-ke', (event) => {
                // Buka URL (WhatsApp) di tab baru
                window.open(event.url, '_blank');
            });
        });
    </script>
</body>
</html>