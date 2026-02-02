<?php

namespace App\Filament\Exports;

use App\Models\UMKM;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UmkmExporter extends Exporter
{
    protected static ?string $model = UMKM::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nama_usaha')
                ->label('Nama Usaha'),
            ExportColumn::make('nama_pemilik')
                ->label('Nama Pemilik'),
            ExportColumn::make('subsektor.nama_subsektor')
                ->label('Subsektor'),
            ExportColumn::make('alamat_usaha')
                ->label('Alamat Usaha'),
            ExportColumn::make('kecamatan.nama_kecamatan')
                ->label('Kecamatan'),
            ExportColumn::make('desa.nama_desa')
                ->label('Desa'),
            ExportColumn::make('tahun_berdiri')
                ->label('Tahun Berdiri'),
            ExportColumn::make('jumlah_tenaga_kerja')
                ->label('Jumlah Tenaga Kerja'),
            ExportColumn::make('omset_tahun')
                ->label('Omset Tahunan'),
            ExportColumn::make('no_telp')
                ->label('Nomor Telepon'),
            ExportColumn::make('email'),
            ExportColumn::make('jenis_badan_usaha')
                ->label('Jenis Badan Usaha'),
            ExportColumn::make('jenis_hki')
                ->label('Jenis HAKI'),
            ExportColumn::make('nib'),
            ExportColumn::make('facebook'),
            ExportColumn::make('instagram'),
            ExportColumn::make('tiktok'),
            ExportColumn::make('whatsapp'),
            ExportColumn::make('website'),
            ExportColumn::make('logo'),
            ExportColumn::make('deskripsi'),
            ExportColumn::make('status_aktif')
                ->label('Status Aktif'),
            ExportColumn::make('status_verifikasi')
                ->label('Status Verifikasi'),
            ExportColumn::make('views'),
            ExportColumn::make('created_at')
                ->label('Tanggal Dibuat'),
            ExportColumn::make('updated_at')
                ->label('Tanggal Diubah'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your umkm export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}