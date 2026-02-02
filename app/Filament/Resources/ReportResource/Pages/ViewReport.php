<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\UMKM;
use App\Models\Subsektor;
use App\Models\Kecamatan;
use Filament\Actions;
use Filament\Resources\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Filament\Widgets\UMKMReportChartWidget;

class ViewReport extends Page
{
    protected static string $resource = ReportResource::class;

    protected static string $view = 'filament.resources.report-resource.pages.view-report';

    public $reportId;

    public function mount($record): void
    {
        $this->reportId = $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->url(ReportResource::getUrl('index'))
                ->button(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        // Only show chart widget for the main statistics report (report ID 1)
        if ($this->reportId == 1) {
            return [
                UMKMReportChartWidget::class,
            ];
        }

        return [];
    }

    public function getFooterWidgetsColumns(): int
    {
        return 1;
    }

    public function getHeading(): string
    {
        return match($this->reportId) {
            1 => 'Statistik UMKM',
            2 => 'UMKM Berdasarkan Subsektor',
            3 => 'UMKM Berdasarkan Kecamatan',
            4 => 'UMKM Berdasarkan Status Verifikasi',
            5 => 'UMKM Berdasarkan Tahun Berdiri',
            default => 'Laporan Tidak Dikenal'
        };
    }

    protected function getViewData(): array
    {
        $reportData = [];

        switch($this->reportId) {
            case 1: // Statistik UMKM
                $reportData = [
                    'total_umkm' => UMKM::count(),
                    'active_umkm' => UMKM::where('status_aktif', true)->count(),
                    'verified_umkm' => UMKM::where('status_verifikasi', true)->count(),
                    'total_sectors' => Subsektor::count(),
                    'total_kecamatan' => Kecamatan::count(),
                    'avg_workers' => round(UMKM::avg('jumlah_tenaga_kerja') ?? 0, 2),
                    'avg_revenue' => round(UMKM::avg('omset_tahun') ?? 0, 2),
                ];
                break;

            case 2: // UMKM Berdasarkan Subsektor
                $reportData = DB::table('umkms')
                    ->join('subsektors', 'umkms.subsektor_id', '=', 'subsektors.id')
                    ->select('subsektors.nama_subsektor', DB::raw('COUNT(*) as count'))
                    ->groupBy('subsektors.nama_subsektor')
                    ->orderByDesc('count')
                    ->get();
                break;

            case 3: // UMKM Berdasarkan Kecamatan
                $reportData = DB::table('umkms')
                    ->join('kecamatans', 'umkms.kecamatan_id', '=', 'kecamatans.id')
                    ->select('kecamatans.nama_kecamatan', DB::raw('COUNT(*) as count'))
                    ->groupBy('kecamatans.nama_kecamatan')
                    ->orderByDesc('count')
                    ->get();
                break;

            case 4: // UMKM Berdasarkan Status Verifikasi
                $reportData = [
                    'verified' => UMKM::where('status_verifikasi', true)->count(),
                    'unverified' => UMKM::where('status_verifikasi', false)->count(),
                    'active' => UMKM::where('status_aktif', true)->count(),
                    'inactive' => UMKM::where('status_aktif', false)->count(),
                ];
                break;

            case 5: // UMKM Berdasarkan Tahun Berdiri
                $reportData = DB::table('umkms')
                    ->select(DB::raw('tahun_berdiri, COUNT(*) as count'))
                    ->groupBy('tahun_berdiri')
                    ->orderBy('tahun_berdiri', 'desc')
                    ->limit(10) // Last 10 years
                    ->get();
                break;
        }

        return [
            'reportId' => $this->reportId,
            'reportData' => $reportData,
        ];
    }
}