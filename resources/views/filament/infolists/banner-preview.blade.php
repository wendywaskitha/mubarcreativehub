<div class="space-y-4">
    {{-- Desktop Preview --}}
    <div>
        <h4 class="text-sm font-semibold text-gray-700 mb-2">💻 Preview Desktop</h4>
        <div class="relative rounded-xl overflow-hidden shadow-2xl border-2 border-gray-200">
            @if($getRecord()->image_desktop)
                <img src="{{ Storage::url($getRecord()->image_desktop) }}"
                     alt="{{ $getRecord()->judul }}"
                     class="w-full h-auto">
            @else
                <div class="w-full h-64 bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Tidak ada gambar</span>
                </div>
            @endif

            {{-- Overlay Text --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center">
                <div class="text-white p-8 max-w-2xl">
                    <h2 class="text-4xl font-bold mb-3">{{ $getRecord()->judul }}</h2>
                    @if($getRecord()->subtitle)
                        <p class="text-lg mb-4">{{ $getRecord()->subtitle }}</p>
                    @endif
                    @if($getRecord()->button_text)
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg">
                            {{ $getRecord()->button_text }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Preview --}}
    @if($getRecord()->image_mobile)
    <div>
        <h4 class="text-sm font-semibold text-gray-700 mb-2">📱 Preview Mobile</h4>
        <div class="max-w-sm mx-auto">
            <div class="relative rounded-xl overflow-hidden shadow-2xl border-2 border-gray-200">
                <img src="{{ Storage::url($getRecord()->image_mobile) }}"
                     alt="{{ $getRecord()->judul }}"
                     class="w-full h-auto">

                {{-- Overlay Text --}}
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/60 flex flex-col justify-end">
                    <div class="text-white p-6">
                        <h3 class="text-2xl font-bold mb-2">{{ $getRecord()->judul }}</h3>
                        @if($getRecord()->subtitle)
                            <p class="text-sm mb-3">{{ Str::limit($getRecord()->subtitle, 80) }}</p>
                        @endif
                        @if($getRecord()->button_text)
                            <button class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg text-sm">
                                {{ $getRecord()->button_text }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
