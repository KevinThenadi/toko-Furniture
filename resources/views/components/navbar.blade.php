<nav class="navbar navbar-expand-lg py-3 fixed-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase text-dark" href="{{ url('/') }}">
            Toko Furniture
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="bi bi-list fs-2"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
            <ul class="navbar-nav gap-3 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="{{ url('/tentang') }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ url('/kontak') }}">Kontak</a>
                </li>

                <li class="nav-item ms-2">
                    <button type="button" class="btn btn-outline-secondary no-border"
                        data-bs-toggle="modal" 
                        data-bs-target="#searchModal">
                    <i class="bi bi-search fs-5"></i>
                </button>
                </li>

                        <li class="nav-item">
                <a href="{{ route('visual-search') }}" 
                class="btn btn-outline-secondary border-0 position-relative" 
                title="Cari dengan Gambar">
                    <i class="bi bi-camera fs-5"></i>
                    
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.5rem;">
                        AI
                    </span>
                </a>
            </li>

                            <li class="nav-item">
                    <a class="nav-link {{ request()->is('room-planner') ? 'active' : '' }}" 
                    href="{{ url('/room-planner') }}" 
                    style="color: #e67e22; font-weight: bold;">
                    <i class="bi bi-palette-fill me-1"></i> Desain Ruangan
                    </a>
                </li>
                <li class="nav-item">
                    <livewire:keranjang-ikon />
                </li>
            </ul>
        </div>
    </div>
</nav>

<livewire:search-modal />