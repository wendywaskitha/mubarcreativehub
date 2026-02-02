@php
    $key = $getRecord()->key;
    $value = $getRecord()->value;
@endphp

<div class="space-y-4">
    @if(in_array($key, ['facebook_url', 'instagram_url', 'twitter_url', 'youtube_url']))
        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm font-semibold text-blue-800 mb-2">🔗 Preview Link:</p>
            <a href="{{ $value }}" target="_blank" class="text-blue-600 hover:underline break-all">
                {{ $value }}
            </a>
        </div>
    @endif

    @if($key === 'whatsapp_cs_number')
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm font-semibold text-green-800 mb-2">💬 WhatsApp Link:</p>
            <a href="https://wa.me/{{ $value }}" target="_blank" class="text-green-600 hover:underline">
                https://wa.me/{{ $value }}
            </a>
        </div>
    @endif

    @if($key === 'site_title')
        <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
            <p class="text-sm font-semibold text-purple-800 mb-2">🌐 Preview Browser Tab:</p>
            <div class="flex items-center gap-2 p-2 bg-white rounded border">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16z"/>
                </svg>
                <span class="font-medium">{{ $value }}</span>
            </div>
        </div>
    @endif

    @if(in_array($key, ['meta_description', 'site_description']))
        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p class="text-sm font-semibold text-yellow-800 mb-2">📝 Jumlah Karakter:</p>
            <div class="space-y-1">
                <p class="text-sm text-gray-700">{{ strlen($value) }} karakter</p>
                @if(strlen($value) > 160)
                    <p class="text-xs text-orange-600">⚠️ Melebihi 160 karakter (tidak optimal untuk SEO)</p>
                @else
                    <p class="text-xs text-green-600">✅ Panjang optimal untuk SEO</p>
                @endif
            </div>
        </div>
    @endif
</div>
