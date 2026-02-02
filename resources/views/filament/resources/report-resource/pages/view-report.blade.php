<x-filament-panels::page>
    <div class="space-y-6">
        @switch($reportId)
            @case(1) {{-- Statistik UMKM --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <x-filament::card class="p-6">
                        <div class="flex items-center">
                            <div class="bg-primary-100 p-3 rounded-lg mr-4">
                                <x-heroicon-o-building-storefront class="h-8 w-8 text-primary-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total UMKM</p>
                                <p class="text-2xl font-bold">{{ number_format($reportData['total_umkm']) }}</p>
                            </div>
                        </div>
                    </x-filament::card>

                    <x-filament::card class="p-6">
                        <div class="flex items-center">
                            <div class="bg-success-100 p-3 rounded-lg mr-4">
                                <x-heroicon-o-check-circle class="h-8 w-8 text-success-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Aktif</p>
                                <p class="text-2xl font-bold">{{ number_format($reportData['active_umkm']) }}</p>
                            </div>
                        </div>
                    </x-filament::card>

                    <x-filament::card class="p-6">
                        <div class="flex items-center">
                            <div class="bg-info-100 p-3 rounded-lg mr-4">
                                <x-heroicon-o-shield-check class="h-8 w-8 text-info-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
                                <p class="text-2xl font-bold">{{ number_format($reportData['verified_umkm']) }}</p>
                            </div>
                        </div>
                    </x-filament::card>

                    <x-filament::card class="p-6">
                        <div class="flex items-center">
                            <div class="bg-warning-100 p-3 rounded-lg mr-4">
                                <x-heroicon-o-users class="h-8 w-8 text-warning-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Rata-rata Tenaga Kerja</p>
                                <p class="text-2xl font-bold">{{ $reportData['avg_workers'] }}</p>
                            </div>
                        </div>
                    </x-filament::card>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-filament::card class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Statistik Tambahan</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Total Subsektor:</span>
                                <span class="font-medium">{{ $reportData['total_sectors'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total Kecamatan:</span>
                                <span class="font-medium">{{ $reportData['total_kecamatan'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Rata-rata Omset Tahunan:</span>
                                <span class="font-medium">Rp {{ number_format($reportData['avg_revenue']) }}</span>
                            </div>
                        </div>
                    </x-filament::card>
                </div>
                @break

            @case(2) {{-- UMKM Berdasarkan Subsektor --}}
                <x-filament::card class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Distribusi UMKM Berdasarkan Subsektor</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subsektor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah UMKM</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reportData as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_subsektor }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-filament::card>
                @break

            @case(3) {{-- UMKM Berdasarkan Kecamatan --}}
                <x-filament::card class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Distribusi UMKM Berdasarkan Kecamatan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah UMKM</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reportData as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_kecamatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-filament::card>
                @break

            @case(4) {{-- UMKM Berdasarkan Status Verifikasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-filament::card class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Status Verifikasi</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Terverifikasi:</span>
                                <span class="font-medium text-success-600">{{ $reportData['verified'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Belum Terverifikasi:</span>
                                <span class="font-medium text-danger-600">{{ $reportData['unverified'] }}</span>
                            </div>
                        </div>
                    </x-filament::card>

                    <x-filament::card class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Status Aktif</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Aktif:</span>
                                <span class="font-medium text-success-600">{{ $reportData['active'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tidak Aktif:</span>
                                <span class="font-medium text-danger-600">{{ $reportData['inactive'] }}</span>
                            </div>
                        </div>
                    </x-filament::card>
                </div>
                @break

            @case(5) {{-- UMKM Berdasarkan Tahun Berdiri --}}
                <x-filament::card class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Perkembangan UMKM Berdasarkan Tahun Berdiri</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Berdiri</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah UMKM</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reportData as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->tahun_berdiri }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-filament::card>
                @break

            @default
                <x-filament::card class="p-6">
                    <p class="text-gray-500">Jenis laporan tidak dikenal.</p>
                </x-filament::card>
        @endswitch
    </div>

    <div class="mt-6">
        <x-filament-widgets::widgets
            :widgets="$this->getFooterWidgets()"
            :columns="$this->getFooterWidgetsColumns()"
        />
    </div>
</x-filament-panels::page>