<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use App\Models\Produk;
use App\Models\Kecamatan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Ekonomi Kreatif', UMKM::count())
                ->description('Jumlah pelaku terdaftar')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Produk', Produk::count())
                ->description('Jumlah produk terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->chart([15, 4, 10, 2, 12, 4, 12]),
            Stat::make('Kecamatan', Kecamatan::count())
                ->description('Jumlah kecamatan di Muna Barat')
                ->descriptionIcon('heroicon-m-map-pin')
                ->chart([1, 2, 4, 5, 3, 6, 2]),
        ];
    }
}
