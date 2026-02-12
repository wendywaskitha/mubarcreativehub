<?php

namespace App\Filament\Resources\UMKMResource\Pages;

use App\Filament\Resources\UMKMResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUMKMS extends ListRecords
{
    protected static string $resource = UMKMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
                ->label('Import UMKM')
                ->color('success')
                ->icon('heroicon-o-arrow-up-tray')
                ->use(\App\Imports\UMKMImport::class)
                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                ->sampleExcel(
                    sampleData: [
                        [
                            'nama_usaha' => 'Batik Nusantara',
                            'nama_pemilik' => 'Budi Santoso',
                            'subsektor' => 'Desain',
                            'jenis_badan_usaha' => 'Perseorangan',
                            'tahun_berdiri' => 2020,
                            'alamat_usaha' => 'Jl. Contoh No. 123, RT/RW 001/002',
                            'kecamatan' => 'Magetan',
                            'desa' => 'Sukowinangun',
                            'jumlah_tenaga_kerja' => 5,
                            'omset_tahun' => 50000000,
                            'no_telp' => '6281234567890',
                            'email' => 'usaha@example.com',
                            'jenis_hki' => 'Merek',
                            'nib' => '1234567890123',
                            'facebook' => 'https://facebook.com/contoh',
                            'instagram' => '@contoh',
                            'tiktok' => '@contoh',
                            'whatsapp' => 'https://wa.me/6281234567890',
                            'website' => 'https://website.com',
                            'latitude' => '-7.607213',
                            'longitude' => '110.203792',
                            'deskripsi' => 'Usaha kerajinan batik tradisional',
                            'status_aktif' => 1,
                            'status_verifikasi' => 0,
                        ]
                    ],
                    fileName: 'template-import-umkm.xlsx',
                    sampleButtonLabel: 'Unduh Template',
                ),
        ];
    }
}
