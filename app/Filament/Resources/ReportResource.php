<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\UMKM;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Exports\UmkmExporter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Resources\ReportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReportResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class ReportResource extends Resource
{
    protected static ?string $model = UMKM::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $modelLabel = 'Laporan';

    protected static ?string $pluralModelLabel = 'Laporan';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // No form needed for reports view
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_usaha')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-m-building-storefront')
                    ->iconColor('primary')
                    ->copyable()
                    ->copyMessage('Nama usaha berhasil disalin')
                    ->copyMessageDuration(1500)
                    ->wrap()
                    ->description(fn(UMKM $record): string => $record->jenis_badan_usaha ?? 'Tidak ada data')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('nama_pemilik')
                    ->label('Nama Pemilik')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-user')
                    ->iconColor('success')
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('subsektor.nama_subsektor')
                    ->label('Subsektor')
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-m-tag')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')
                    ->label('Kecamatan')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-map-pin')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('desa.nama_desa')
                    ->label('Desa')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-m-map')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('tahun_berdiri')
                    ->label('Tahun Berdiri')
                    ->sortable()
                    ->icon('heroicon-m-calendar')
                    ->iconColor('warning')
                    ->description(
                        fn(UMKM $record): string =>
                        $record->tahun_berdiri ? (now()->year - $record->tahun_berdiri) . ' tahun beroperasi' : '-'
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('jumlah_tenaga_kerja')
                    ->label('Tenaga Kerja')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-user-group')
                    ->iconColor('indigo')
                    ->suffix(' orang')
                    ->alignCenter()
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state >= 50 => 'success',
                        $state >= 20 => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(),

                Tables\Columns\IconColumn::make('status_verifikasi')
                    ->label('Terverifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('no_telp')
                    ->label('No. Telepon')
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Nomor telepon berhasil disalin')
                    ->url(fn(UMKM $record): string => $record->no_telp ? 'tel:' . $record->no_telp : '#')
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->url(fn(UMKM $record): string => $record->email ? 'mailto:' . $record->email : '#')
                    ->color('primary')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('alamat_usaha')
                    ->label('Alamat Usaha')
                    ->icon('heroicon-m-map-pin')
                    ->wrap()
                    ->lineClamp(2)
                    ->tooltip(fn(UMKM $record): string => $record->alamat_usaha ?? 'Tidak ada alamat')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('jenis_badan_usaha')
                    ->label('Jenis Badan Usaha')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'PT' => 'success',
                        'CV' => 'info',
                        'Koperasi' => 'warning',
                        default => 'gray',
                    })
                    ->icon('heroicon-m-building-office-2')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('jenis_hki')
                    ->label('Jenis HAKI')
                    ->badge()
                    ->color('purple')
                    ->icon('heroicon-m-shield-check')
                    ->placeholder('Belum terdaftar')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('nib')
                    ->label('NIB')
                    ->copyable()
                    ->placeholder('-')
                    ->icon('heroicon-m-identification')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Tables\Columns\TextColumn::make('social_media')
                //     ->label('Media Sosial')
                //     ->html()
                //     ->formatStateUsing(function (UMKM $record): string {
                //         $links = [];
                //         if ($record->facebook) $links[] = '<a href="' . $record->facebook . '" target="_blank" class="text-blue-600">FB</a>';
                //         if ($record->instagram) $links[] = '<a href="' . $record->instagram . '" target="_blank" class="text-pink-600">IG</a>';
                //         if ($record->tiktok) $links[] = '<a href="' . $record->tiktok . '" target="_blank" class="text-gray-800">TT</a>';
                //         if ($record->whatsapp) $links[] = '<a href="https://wa.me/' . $record->whatsapp . '" target="_blank" class="text-green-600">WA</a>';
                //         if ($record->website) $links[] = '<a href="' . $record->website . '" target="_blank" class="text-indigo-600">Web</a>';
                //         return !empty($links) ? implode(' • ', $links) : '-';
                //     })
                //     ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('omset_tahun')
                    ->label('Omset Tahunan')
                    ->money('IDR')
                    ->icon('heroicon-m-banknotes')
                    ->iconColor('success')
                    ->sortable()
                    ->alignEnd()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('IDR')
                            ->label('Total Omset'),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn(UMKM $record): string => $record->deskripsi ?? 'Tidak ada deskripsi')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('status_aktif')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-pause-circle')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('views')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-eye')
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state >= 100 => 'success',
                        $state >= 50 => 'warning',
                        default => 'gray',
                    })
                    ->alignCenter()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Views'),
                        Tables\Columns\Summarizers\Average::make()
                            ->label('Rata-rata')
                            ->numeric(0),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan_id')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Kecamatan')
                    ->label('Kecamatan'),

                Tables\Filters\SelectFilter::make('desa_id')
                    ->relationship('desa', 'nama_desa')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Desa')
                    ->label('Desa'),

                Tables\Filters\SelectFilter::make('subsektor_id')
                    ->relationship('subsektor', 'nama_subsektor')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Subsektor')
                    ->label('Subsektor'),

                Tables\Filters\SelectFilter::make('jenis_badan_usaha')
                    ->options([
                        'Perseorangan' => 'Perseorangan',
                        'CV' => 'CV (Commanditaire Vennootschap)',
                        'UD' => 'UD (Usaha Dagang)',
                        'Kelompok' => 'Kelompok Usaha',
                        'Komunitas' => 'Komunitas',
                        'PT' => 'PT (Perseroan Terbatas)',
                        'Koperasi' => 'Koperasi',
                        'Firma' => 'Firma',
                    ])
                    ->searchable()
                    ->multiple()
                    ->placeholder('Pilih Jenis Badan Usaha')
                    ->indicator('Jenis Badan Usaha')
                    ->label('Jenis Badan Usaha'),

                Tables\Filters\TernaryFilter::make('status_verifikasi')
                    ->placeholder('Semua Status')
                    ->trueLabel('Terverifikasi')
                    ->falseLabel('Belum Terverifikasi')
                    ->indicator('Verifikasi')
                    ->label('Status Verifikasi'),

                Tables\Filters\TernaryFilter::make('status_aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->indicator('Status')
                    ->label('Status Aktif'),

                Tables\Filters\Filter::make('tahun_berdiri')
                    ->form([
                        Forms\Components\TextInput::make('dari')
                            ->numeric()
                            ->placeholder('Dari tahun')
                            ->maxLength(4),
                        Forms\Components\TextInput::make('sampai')
                            ->numeric()
                            ->placeholder('Sampai tahun')
                            ->maxLength(4),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari'],
                                fn(Builder $query, $date): Builder => $query->where('tahun_berdiri', '>=', $date),
                            )
                            ->when(
                                $data['sampai'],
                                fn(Builder $query, $date): Builder => $query->where('tahun_berdiri', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['dari'] ?? null) {
                            $indicators[] = 'Tahun: ' . $data['dari'] . ' - ' . ($data['sampai'] ?? 'sekarang');
                        }
                        return $indicators;
                    }),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->persistFiltersInSession()
            ->filtersTriggerAction(
                fn(Tables\Actions\Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
            ->headerActions([
                FilamentExportHeaderAction::make('export')
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-m-eye')
                    ->color('info'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->label('Export Data')
                        ->icon('heroicon-m-arrow-down-tray')
                        ->exporter(UmkmExporter::class),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data UMKM')
            ->emptyStateDescription('Data laporan UMKM akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-document-chart-bar')
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50, 100])
            ->deferLoading()
            ->poll('60s');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return static::getModel()::query()->with(['kecamatan', 'desa', 'subsektor']);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'view_report' => Pages\ViewReport::route('/{record}/view'),
        ];
    }
}
