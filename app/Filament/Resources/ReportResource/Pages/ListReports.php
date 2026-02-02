<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_pdf')
                ->label('Cetak Laporan PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->modalHeading('Informasi Penanda Tangan')
                ->modalDescription('Silakan masukkan informasi pejabat yang akan ditampilkan di laporan.')
                ->form([
                    \Filament\Forms\Components\TextInput::make('nama_kepala_dinas')
                        ->label('Nama Kepala Dinas')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('pangkat_gol')
                        ->label('Pangkat/Golongan')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->required()
                        ->maxLength(255),
                ])
                ->modalSubmitActionLabel('Cetak PDF')
                ->modalCancelActionLabel('Batal')
                ->action(function (array $data) {
                    session(['pdf_signature_data' => $data]);
                    return redirect('/umkm/pdf/export');
                }),
        ];
    }
}
