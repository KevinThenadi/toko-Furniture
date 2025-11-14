<footer class="text-white pt-5 pb-3" style="background-color: #2d2d2d;">
    <div class="container">
        <div class="row gy-4 align-items-start">
            <!-- Logo & Deskripsi -->
            <div class="col-md-6">
                <h4 class="fw-bold">Toko Furniture</h4>
                <p class="text-light">
                    Kami menyediakan berbagai pilihan furniture berkualitas tinggi dengan desain modern dan elegan.
                    Setiap produk dibuat untuk menghadirkan kenyamanan dan gaya di setiap ruangan rumah Anda.
                </p>

                <div class="mt-3">
                    <a href="https://facebook.com" target="_blank" class="text-light me-3 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="https://instagram.com" target="_blank" class="text-light me-3 fs-5"><i class="bi bi-instagram"></i></a>
    
                    <a href="mailto:support@tokofurniture.id" class="text-light fs-5"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-md-6">
                <h5 class="fw-bold">Hubungi Kami</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i>Jl. Merbau Indah No. 45, Surabaya</li>
                    <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i>support@tokofurniture.id</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i>(031) 567-1234</li>
                    <li><i class="bi bi-whatsapp me-2"></i>+62 813-3187-2285</li>
                </ul>
            </div>
        </div>

        <hr class="border-light mt-4">

        <!-- Hak Cipta -->
        <div class="text-center">
            <p class="mb-0 text-light">
                © {{ date('Y') }} <strong>Toko Furniture</strong>. Dibuat dengan ❤️ untuk Anda.<br>
                <a href="{{ route('privasi') }}" class="text-decoration-none text-light">Kebijakan Privasi</a> • 
                <a href="{{ route('syarat') }}" class="text-decoration-none text-light">Syarat & Ketentuan</a>
            </p>
        </div>
    </div>
</footer>
