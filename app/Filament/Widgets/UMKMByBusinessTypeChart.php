<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UMKMByBusinessTypeChart extends ApexChartWidget
{
    protected static ?string $heading = 'Distribusi Pelaku Ekonomi Kreatif per Jenis Badan Usaha';
    protected static ?string $chartId = 'umkmByBusinessTypeChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::selectRaw('jenis_badan_usaha, COUNT(*) as count')
            ->whereNotNull('jenis_badan_usaha')
            ->where('jenis_badan_usaha', '<>', '')
            ->groupBy('jenis_badan_usaha')
            ->orderBy('count', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'pie',
                    'height' => 300,
                ],
                'series' => [0],
                'labels' => ['Tidak Ada Data'],
            ];
        }

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $data->pluck('count')->toArray(),
            'labels' => $data->pluck('jenis_badan_usaha')->toArray(),
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
