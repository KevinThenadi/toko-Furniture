<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi | Toko Furniture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body>

    <x-navbar />

    <section class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="fw-bold display-5 mb-3">Kebijakan Privasi</h1>
                <p class="text-muted">Terakhir diperbarui: 13 November 2025</p>
                <hr class="my-4">

                <p>Terima kasih telah mengunjungi Toko Furniture. Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>

                <h3 class="fw-bold mt-5">1. Data yang Kami Kumpulkan</h3>
                <p>Kami mengumpulkan data pribadi yang Anda berikan secara langsung kepada kami saat Anda melakukan proses pemesanan. Data ini meliputi:</p>
                <ul>
                    <li><strong>Nama Lengkap Anda</strong></li>
                    <li><strong>Nomor WhatsApp (No. HP)</strong></li>
                    <li>(Sebelumnya) Alamat Email (jika Anda memutuskan untuk menggunakannya lagi)</li>
                    <li>Detail pesanan (produk yang Anda pilih di keranjang)</li>
                </ul>

                <h3 class="fw-bold mt-5">2. Bagaimana Kami Menggunakan Data Anda</h3>
                <p>Data pribadi Anda kami gunakan hanya untuk tujuan berikut:</p>
                <ul>
                    <li>Untuk memproses dan mengkonfirmasi pesanan Anda melalui WhatsApp.</li>
                    <li>Untuk menghubungi Anda terkait pertanyaan, ketersediaan stok, dan total biaya (termasuk ongkos kirim).</li>
                    <li>Untuk menyimpan catatan transaksi internal kami.</li>
                    <li>Kami **tidak** akan menjual atau menyebarkan data pribadi Anda ke pihak ketiga untuk tujuan pemasaran.</li>
                </ul>

                <h3 class="fw-bold mt-5">3. Keamanan Data</h3>
                <p>Kami menyimpan data keranjang Anda di dalam sistem sesi (session) yang aman dan data pesanan Anda (Nama & No. HP) hanya digunakan untuk komunikasi via WhatsApp. Kami tidak menyimpan data sensitif seperti data kartu kredit karena semua proses pembayaran akan dikomunikasikan secara manual oleh admin kami.</p>

                <h3 class="fw-bold mt-5">4. Perubahan Kebijakan</h3>
                <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Perubahan akan diposting di halaman ini, dan kami sarankan Anda untuk meninjau kembali halaman ini secara berkala.</p>

                <h3 class="fw-bold mt-5">5. Kontak Kami</h3>
                <p>Jika Anda memiliki pertanyaan lebih lanjut mengenai kebijakan privasi ini, silakan hubungi kami melalui informasi yang ada di halaman Kontak.</p>
            </div>
        </div>
    </section>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @livewireScripts
</body>
</html>