<div class="flex items-center gap-4 p-6 rounded-xl border-2"
     style="background: {{ $getRecord()->color_code }}15; border-color: {{ $getRecord()->color_code }};">
    <div class="text-6xl">{{ $getRecord()->icon ?? '📦' }}</div>
    <div class="flex-1">
        <h2 class="text-2xl font-bold" style="color: {{ $getRecord()->color_code }};">
            {{ $getRecord()->nama_subsektor }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">Subsektor Ekonomi Kreatif</p>
        <div class="flex gap-2 mt-3">
            <span class="px-3 py-1 rounded-full text-xs font-medium"
                  style="background: {{ $getRecord()->color_code }}25; color: {{ $getRecord()->color_code }};">
                {{ $getRecord()->pelaku_count ?? 0 }} Pelaku
            </span>
        </div>
    </div>
</div>
