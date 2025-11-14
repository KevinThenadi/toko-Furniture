<div>
    <button type="button" class="btn btn-primary btn-lg w-100" 
            data-bs-toggle="modal" 
            data-bs-target="#quantityModal-{{ $produk->id }}"> <i class="bi bi-cart-plus"></i>
        Tambah ke Keranjang
    </button>

    <div class="modal fade" id="quantityModal-{{ $produk->id }}" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">Masukkan Kuantitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/foto/' . $produk->gambar_utama) }}" alt="{{ $produk->nama }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded me-3">
                        <div>
                            <h6 class="mb-0">{{ $produk->nama }}</h6>
                            <span class="price-normal">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <hr>

                    <label for="kuantitas" class="form-label">Jumlah:</label>
                    <div class="input-group" style="max-width: 200px;">
                        <button wire:click="decrement" class="btn btn-outline-secondary" type="button">-</button>
                        
                        <input type="text" 
                               wire:model="kuantitas" 
                               class="form-control text-center" 
                               id="kuantitas" 
                               value="1" 
                               min="1">
                        
                        <button wire:click="increment" class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    
                    <button type="button" 
                            wire:click="addToCart" 
                            class="btn btn-primary" 
                            data-bs-dismiss="modal">
                        Ya, Tambahkan ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>