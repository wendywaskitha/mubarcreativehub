<?php

namespace App\Filament\Widgets;

use App\Models\UMKM;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UMKMChartWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Distribusi UMKM per Kecamatan';
    protected static ?string $chartId = 'umkmChartByKecamatan';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $contentHeight = 300;
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        $data = UMKM::selectRaw('kecamatans.nama_kecamatan as kecamatan, COUNT(umkms.id) as count')
            ->join('kecamatans', 'umkms.kecamatan_id', '=', 'kecamatans.id')
            ->groupBy('kecamatans.nama_kecamatan')
            ->orderBy('count', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return [
                'chart' => [
                    'type' => 'bar',
                    'height' => 300,
                ],
                'series' => [[
                    'name' => 'Jumlah UMKM',
                    'data' => [0],
                ]],
                'xaxis' => [
                    'categories' => ['Tidak Ada Data'],
                    'title' => [
                        'text' => 'Kecamatan',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Jumlah UMKM',
                    ],
                ],
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [[
                'name' => 'Jumlah UMKM',
                'data' => $data->pluck('count')->toArray(),
            ]],
            'xaxis' => [
                'categories' => $data->pluck('kecamatan')->toArray(),
                'title' => [
                    'text' => 'Kecamatan',
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => 'Jumlah UMKM',
                ],
            ],
        ];
    }
}
