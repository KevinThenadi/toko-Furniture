




<section class="container py-5">
    <h1 class="fw-bold display-5 mb-4">Keranjang Anda</h1>

    @if (empty($keranjang))
        <div class="alert alert-secondary text-center" role="alert">
            <p class="fs-4 mb-2">Keranjang Anda masih kosong.</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Mulai Belanja</a> </div>
    
    @else
        <div class="row g-5">
            
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($keranjang as $id => $item)
                            <li class="list-group-item p-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/foto/' . $item['gambar']) }}" 
                                         alt="{{ $item['nama'] }}" 
                                         style="width: 80px; height: 80px; object-fit: cover;" 
                                         class="rounded me-3">
                                    
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">{{ $item['nama'] }}</h5>
                                        <div class="d-flex align-items-center my-2">
                                            <button wire:click="kurangiKuantitas({{ $id }})" class="btn btn-sm btn-outline-secondary" wire:loading.attr="disabled" wire:target="kurangiKuantitas">-</button>
                                            <span class="mx-3" style="width: 20px; text-align: center;">{{ $item['kuantitas'] }}</span>
                                            <button wire:click="tambahKuantitas({{ $id }})" class="btn btn-sm btn-outline-secondary" wire:loading.attr="disabled" wire:target="tambahKuantitas">+</button>
                                        </div>
                                        <small class="text-muted">Harga: Rp {{ number_format($item['harga'], 0, ',', '.') }}</small>
                                    </div>
                                    
                                    <div class="text-end ms-3">
                                        <h6 class="fw-bold price-normal mb-2">Rp {{ number_format($item['harga'] * $item['kuantitas'], 0, ',', '.') }}</h6>
                                        <button wire:click="hapusItem({{ $id }})" class="btn btn-sm btn-outline-danger" title="Hapus item">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0" style="position: sticky; top: 100px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3">Ringkasan Pesanan</h3>
                        
                        <div class="d-flex justify-content-between fs-5 mb-3">
                            <span class="text-muted">Total Harga:</span>
                            <span class="fw-bold price-normal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <hr class="my-3">
                        
                        <p class="text-muted">Isi data Anda untuk melanjutkan pesanan via WhatsApp.</p>

                        <form wire:submit="pesanSekarang">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input wire:model="nama" type="text" class="form-control" id="nama" placeholder="Nama Anda">
                                @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. WhatsApp</label>
                                <input wire:model="no_hp" type="tel" class="form-control" id="no_hp" placeholder="08123456...">
                                @error('no_hp') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" wire:loading.attr="disabled" style = "background-color: #25D366; border-color: #25D366;">
                                <span wire:loading.remove wire:target="pesanSekarang">
                                    <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                                </span>
                                <span wire:loading wire:target="pesanSekarang">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Memproses...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>