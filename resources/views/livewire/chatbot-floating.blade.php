<div class="fixed-bottom end-0 p-4" style="z-index: 9999;">
    
    @if($isOpen)
    <div class="card shadow-lg mb-3 border-0" style="width: 350px; border-radius: 15px; overflow: hidden;">
        
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-robot fs-4"></i>
                <div>
                    <h6 class="mb-0 fw-bold" >CS AI Assistant</h6>
                    <small style="font-size: 10px;">Powered by Llama 3</small>
                </div>
            </div>
            <button wire:click="toggleChat" class="btn btn-sm text-white"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="card-body bg-light" style="height: 350px; overflow-y: auto;">
            
            <div class="d-flex flex-column align-items-start mb-2">
                <div class="bg-white text-dark p-2 rounded shadow-sm" style="max-width: 80%; border-bottom-left-radius: 0;">
                    Halo! Ada yang bisa saya bantu carikan untuk furnitur rumah Anda? 🏠
                </div>
            </div>

            @foreach($riwayatChat as $chat)
                <div class="d-flex flex-column mb-2 {{ $chat['role'] == 'user' ? 'align-items-end' : 'align-items-start' }}">
                    <div class="p-2 rounded shadow-sm {{ $chat['role'] == 'user' ? 'bg-primary text-white' : 'bg-white text-dark' }}" 
                        style="max-width: 80%; border-bottom-{{ $chat['role'] == 'user' ? 'right' : 'left' }}-radius: 0;">
                        
                        @if($chat['role'] == 'bot')
                            {!! Str::markdown($chat['msg']) !!}
                        @else
                            {{ $chat['msg'] }}
                        @endif

                    </div>
                </div>
            @endforeach

            @if($isTyping)
                <div class="text-muted small ms-2">
                    <em>AI sedang mengetik...</em>
                </div>
            @endif
        </div>

        <div class="card-footer bg-white p-2">
            <form wire:submit.prevent="kirimPesan" class="d-flex gap-2">
                <input wire:model="inputPesan" type="text" class="form-control border-0 bg-light" placeholder="Tulis pesan..." required>
                <button type="submit" class="btn btn-primary rounded-circle">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
    </div>
    @endif

    <button wire:click="toggleChat" 
            class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center p-0" 
            style="width: 60px; height: 60px; transition: transform 0.2s;"
            onmouseover="this.style.transform='scale(1.1)'" 
            onmouseout="this.style.transform='scale(1)'">
        
        @if($isOpen)
            <i class="bi bi-x-lg fs-3"></i>
        @else
            <i class="bi bi-chat-dots-fill fs-3"></i>
        @endif
    </button>
</div>