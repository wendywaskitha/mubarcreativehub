<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TopUMKMEmployeesChart extends ApexChartWidget
{
    protected static ?string $heading = 'Top 10 UMKM dengan Tenaga Kerja Terbanyak';
    protected static ?string $chartId = 'topUMKMEmployeesChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::select('nama_usaha', 'jumlah_tenaga_kerja')
            ->whereNotNull('jumlah_tenaga_kerja')
            ->where('jumlah_tenaga_kerja', '>', 0)
            ->orderBy('jumlah_tenaga_kerja', 'desc')
            ->limit(10)
            ->get();

        if ($data->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'bar',
                    'height' => 300,
                ],
                'series' => [[
                    'name' => 'Jumlah Tenaga Kerja',
                    'data' => [0],
                ]],
                'xaxis' => [
                    'categories' => ['Tidak Ada Data'],
                    'title' => [
                        'text' => 'Nama Usaha',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Jumlah Tenaga Kerja',
                    ],
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [[
                'name' => 'Jumlah Tenaga Kerja',
                'data' => $data->pluck('jumlah_tenaga_kerja')->toArray(),
            ]],
            'xaxis' => [
                'categories' => $data->pluck('nama_usaha')->toArray(),
                'title' => [
                    'text' => 'Nama Usaha',
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Jumlah Tenaga Kerja',
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => true,
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
            ],
        ];
    }
}