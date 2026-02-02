<div class="space-y-6">
    <div class="text-center">
        <div class="inline-flex items-center gap-4 p-8 rounded-2xl border-2"
             style="background: {{ $record->color_code }}10; border-color: {{ $record->color_code }};">
            <span class="text-8xl">{{ $record->icon ?? '📦' }}</span>
            <div class="text-left">
                <h3 class="text-3xl font-bold" style="color: {{ $record->color_code }};">
                    {{ $record->nama_subsektor }}
                </h3>
                <p class="text-gray-600 mt-1">Subsektor Ekonomi Kreatif</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-gray-50 rounded-lg text-center">
            <div class="text-3xl mb-2">{{ $record->icon ?? '📦' }}</div>
            <p class="text-xs text-gray-600">Ikon</p>
        </div>
        <div class="p-4 rounded-lg text-center" style="background: {{ $record->color_code }}20;">
            <div class="w-12 h-12 rounded-full mx-auto mb-2" style="background: {{ $record->color_code }};"></div>
            <p class="text-xs text-gray-600">{{ $record->color_code }}</p>
        </div>
        <div class="p-4 bg-gray-50 rounded-lg text-center">
            <div class="text-2xl font-bold text-green-600 mb-1">{{ $record->pelaku_count ?? 0 }}</div>
            <p class="text-xs text-gray-600">Total Pelaku</p>
        </div>
    </div>
</div>
