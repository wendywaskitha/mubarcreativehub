<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UMKMBySubsectorChart extends ApexChartWidget
{
    protected static ?string $heading = 'Distribusi Pelaku Ekonomi Kreatif per Subsektor';
    protected static ?string $chartId = 'umkmBySubsectorChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::selectRaw('subsektors.nama_subsektor, COUNT(*) as count')
            ->leftJoin('subsektors', 'umkms.subsektor_id', '=', 'subsektors.id')
            ->groupBy('subsektors.nama_subsektor', 'subsektors.id')
            ->orderBy('count', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'donut',
                    'height' => 300,
                ],
                'series' => [0],
                'labels' => ['Tidak Ada Data'],
            ];
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $data->pluck('count')->toArray(),
            'labels' => $data->pluck('nama_subsektor')->toArray(),
            'legend' => [
                'position' => 'bottom',
            ],
            'responsive' => [[
                'breakpoint' => 480,
                'options' => [
                    'chart' => [
                        'width' => 300,
                    ],
                    'legend' => [
                        'position' => 'bottom',
                    ],
                ],
            ]],
        ];
    }
}
