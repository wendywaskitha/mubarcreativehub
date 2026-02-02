<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UMKMGrowthChart extends ApexChartWidget
{
    protected static ?string $heading = 'Perkembangan Jumlah Pelaku Ekonomi Kreatif per Tahun Berdiri';
    protected static ?string $chartId = 'umkmGrowthChart';
    protected static ?int $contentHeight = 300;
    protected int | string | array $columnSpan = 'full';
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::selectRaw('tahun_berdiri, COUNT(*) as count')
            ->whereNotNull('tahun_berdiri')
            ->where('tahun_berdiri', '>', 0)
            ->groupBy('tahun_berdiri')
            ->orderBy('tahun_berdiri')
            ->get();

        if ($data->isEmpty()) {
            return [];
        }

        // Convert tahun_berdiri to string to ensure proper formatting
        $categories = $data->pluck('tahun_berdiri')->map(function ($item) {
            return (string) $item;
        })->toArray();

        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [[
                'name' => 'Jumlah Pelaku',
                'data' => $data->pluck('count')->toArray(),
            ]],
            'xaxis' => [
                'categories' => $categories,
                'title' => [
                    'text' => 'Tahun',
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Jumlah Pelaku',
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'markers' => [
                'size' => 6,
                'hover' => [
                    'size' => 10,
                ],
            ],
        ];
    }
}
