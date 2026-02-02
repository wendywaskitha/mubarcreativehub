<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\UMKM;
use App\Models\Subsektor;
use Illuminate\Support\Facades\DB;

class UMKMReportChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik UMKM';

    protected int|string|array $columnSpan = 'full';

    public ?string $filter = 'all';

    protected function getData(): array
    {
        $umkmData = [];
        
        switch ($this->filter) {
            case 'by_sector':
                // Data for UMKM by sector chart
                $umkmData = DB::table('umkms')
                    ->join('subsektors', 'umkms.subsektor_id', '=', 'subsektors.id')
                    ->select('subsektors.nama_subsektor as name', DB::raw('COUNT(*) as count'))
                    ->groupBy('subsektors.nama_subsektor')
                    ->orderByDesc('count')
                    ->limit(10)
                    ->get();
                
                return [
                    'datasets' => [
                        [
                            'label' => 'Jumlah UMKM',
                            'data' => $umkmData->pluck('count')->toArray(),
                            'backgroundColor' => [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(199, 199, 199, 0.8)',
                                'rgba(83, 102, 255, 0.8)',
                                'rgba(255, 83, 102, 0.8)',
                                'rgba(102, 255, 83, 0.8)',
                            ],
                        ],
                    ],
                    'labels' => $umkmData->pluck('name')->toArray(),
                ];
                
            case 'by_kecamatan':
                // Data for UMKM by district chart
                $umkmData = DB::table('umkms')
                    ->join('kecamatans', 'umkms.kecamatan_id', '=', 'kecamatans.id')
                    ->select('kecamatans.nama_kecamatan as name', DB::raw('COUNT(*) as count'))
                    ->groupBy('kecamatans.nama_kecamatan')
                    ->orderByDesc('count')
                    ->limit(10)
                    ->get();
                
                return [
                    'datasets' => [
                        [
                            'label' => 'Jumlah UMKM',
                            'data' => $umkmData->pluck('count')->toArray(),
                            'backgroundColor' => [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(199, 199, 199, 0.8)',
                                'rgba(83, 102, 255, 0.8)',
                                'rgba(255, 83, 102, 0.8)',
                                'rgba(102, 255, 83, 0.8)',
                            ],
                        ],
                    ],
                    'labels' => $umkmData->pluck('name')->toArray(),
                ];
                
            case 'by_verification':
                // Data for UMKM by verification status
                $verifiedCount = UMKM::where('status_verifikasi', true)->count();
                $unverifiedCount = UMKM::where('status_verifikasi', false)->count();
                
                return [
                    'datasets' => [
                        [
                            'label' => 'Status Verifikasi',
                            'data' => [$verifiedCount, $unverifiedCount],
                            'backgroundColor' => [
                                'rgba(75, 192, 192, 0.8)', // Verified (teal)
                                'rgba(255, 99, 132, 0.8)', // Unverified (red)
                            ],
                        ],
                    ],
                    'labels' => ['Terverifikasi', 'Belum Terverifikasi'],
                ];
                
            case 'by_year':
                // Data for UMKM by year founded
                $umkmData = DB::table('umkms')
                    ->select(DB::raw('tahun_berdiri as year'), DB::raw('COUNT(*) as count'))
                    ->whereNotNull('tahun_berdiri')
                    ->groupBy('tahun_berdiri')
                    ->orderBy('tahun_berdiri', 'desc')
                    ->limit(10)
                    ->get();
                
                return [
                    'datasets' => [
                        [
                            'label' => 'Jumlah UMKM',
                            'data' => $umkmData->pluck('count')->reverse()->values()->toArray(),
                            'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                        ],
                    ],
                    'labels' => $umkmData->pluck('year')->reverse()->values()->toArray(),
                ];
                
            default: // Overall stats
                $totalUmkm = UMKM::count();
                $activeUmkm = UMKM::where('status_aktif', true)->count();
                $verifiedUmkm = UMKM::where('status_verifikasi', true)->count();
                $sectorsCount = Subsektor::count();
                
                return [
                    'datasets' => [
                        [
                            'label' => 'Statistik',
                            'data' => [$totalUmkm, $activeUmkm, $verifiedUmkm, $sectorsCount],
                            'backgroundColor' => [
                                'rgba(54, 162, 235, 0.8)', // Total UMKM (blue)
                                'rgba(75, 192, 192, 0.8)', // Active (teal)
                                'rgba(153, 102, 255, 0.8)', // Verified (purple)
                                'rgba(255, 159, 64, 0.8)',  // Sectors (orange)
                            ],
                        ],
                    ],
                    'labels' => ['Total UMKM', 'Aktif', 'Terverifikasi', 'Subsektor'],
                ];
        }
    }

    protected function getType(): string
    {
        return 'bar'; // Using bar charts for most reports, pie for verification status
    }

    protected function getFilters(): ?array
    {
        return [
            'all' => 'Statistik Keseluruhan',
            'by_sector' => 'Berdasarkan Subsektor',
            'by_kecamatan' => 'Berdasarkan Kecamatan',
            'by_verification' => 'Berdasarkan Verifikasi',
            'by_year' => 'Berdasarkan Tahun Berdiri',
        ];
    }
}