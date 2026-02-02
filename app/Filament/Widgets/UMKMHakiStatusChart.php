<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UMKMHakiStatusChart extends ApexChartWidget
{
    protected static ?string $heading = 'Distribusi UMKM berdasarkan Status HAKI';
    protected static ?string $chartId = 'umkmHakiStatusChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::selectRaw('jenis_hki, COUNT(*) as count')
            ->whereNotNull('jenis_hki')
            ->where('jenis_hki', '<>', '')
            ->groupBy('jenis_hki')
            ->orderBy('count', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'column',
                    'height' => 300,
                ],
                'series' => [[
                    'name' => 'Jumlah UMKM',
                    'data' => [0],
                ]],
                'xaxis' => [
                    'categories' => ['Tidak Ada Data'],
                    'title' => [
                        'text' => 'Jenis HAKI',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Jumlah UMKM',
                    ],
                ],
                'plotOptions' => [
                    'bar' => [
                        'borderRadius' => 4,
                        'horizontal' => false,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
            ];
        }

        return [
            'chart' => [
                'type' => 'column',
                'height' => 300,
            ],
            'series' => [[
                'name' => 'Jumlah UMKM',
                'data' => $data->pluck('count')->toArray(),
            ]],
            'xaxis' => [
                'categories' => $data->pluck('jenis_hki')->toArray(),
                'title' => [
                    'text' => 'Jenis HAKI',
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Jumlah UMKM',
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 4,
                    'horizontal' => false,
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
}