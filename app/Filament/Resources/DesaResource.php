<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesaResource\Pages;
use App\Filament\Resources\DesaResource\RelationManagers;
use App\Models\Desa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class DesaResource extends Resource
{
    protected static ?string $model = Desa::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationLabel = 'Desa/Kelurahan';

    protected static ?string $modelLabel = 'Desa';

    protected static ?string $pluralModelLabel = 'Data Desa/Kelurahan';

    protected static ?string $navigationGroup = 'Wilayah Administratif';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'nama_desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Desa/Kelurahan')
                    ->description('Lengkapi data desa atau kelurahan dengan detail kecamatan')
                    ->icon('heroicon-o-building-library')
                    ->schema([
                        Forms\Components\TextInput::make('nama_desa')
                            ->label('Nama Desa/Kelurahan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Desa Wangi-Wangi atau Kelurahan Mandati')
                            ->prefixIcon('heroicon-o-home')
                            ->columnSpanFull()
                            ->autocomplete(false)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('nama_desa', ucwords(strtolower($state)));
                            })
                            ->helperText('Nama akan otomatis diformat dengan huruf kapital di awal kata'),

                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Kecamatan')
                            ->relationship('kecamatan', 'nama_kecamatan')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-o-map-pin')
                            ->placeholder('Pilih kecamatan induk')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama_kecamatan')
                                    ->label('Nama Kecamatan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                            ])
                            ->createOptionModalHeading('Tambah Kecamatan Baru')
                            ->editOptionForm([
                                Forms\Components\TextInput::make('nama_kecamatan')
                                    ->label('Nama Kecamatan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                            ])
                            ->columnSpanFull()
                            ->helperText('Pilih kecamatan dari daftar atau tambahkan yang baru')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state) {
                                    $kecamatan = \App\Models\Kecamatan::find($state);
                                    if ($kecamatan) {
                                        // You can add additional logic here
                                    }
                                }
                            }),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Informasi Tambahan')
                    ->description('Metadata dan informasi pelengkap')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\Placeholder::make('info')
                            ->label('')
                            ->content(fn ($get) =>
                                $get('kecamatan_id')
                                    ? '✅ Data akan tersimpan di kecamatan: ' .
                                      (\App\Models\Kecamatan::find($get('kecamatan_id'))?->nama_kecamatan ?? '-')
                                    : '💡 Tips: Pilih kecamatan terlebih dahulu untuk melanjutkan'
                            ),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('nama_desa')
                    ->label('Nama Desa/Kelurahan')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-home-modern')
                    ->iconColor('primary')
                    ->weight(FontWeight::SemiBold)
                    ->copyable()
                    ->copyMessage('Nama desa disalin!')
                    ->copyMessageDuration(1500)
                    ->description(fn (Desa $record): string =>
                        'Kec. ' . $record->kecamatan->nama_kecamatan
                    )
                    ->wrap(),

                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')
                    ->label('Kecamatan')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-map-pin')
                    ->badge()
                    ->color('success')
                    ->toggleable()
                    ->url(fn (Desa $record): string =>
                        route('filament.admin.resources.kecamatans.view', ['record' => $record->kecamatan_id])
                    )
                    ->tooltip('Klik untuk lihat detail kecamatan'),

                Tables\Columns\TextColumn::make('kecamatan.latitude')
                    ->label('Lat. Kecamatan')
                    ->numeric(decimalPlaces: 4)
                    ->alignCenter()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-globe-alt')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->default('-'),

                Tables\Columns\TextColumn::make('kecamatan.longitude')
                    ->label('Long. Kecamatan')
                    ->numeric(decimalPlaces: 4)
                    ->alignCenter()
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-globe-alt')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->default('-'),

                Tables\Columns\IconColumn::make('has_kecamatan_coordinates')
                    ->label('Status Koordinat')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->getStateUsing(fn (Desa $record): bool =>
                        !empty($record->kecamatan->latitude) && !empty($record->kecamatan->longitude)
                    )
                    ->tooltip(fn (Desa $record): string =>
                        (!empty($record->kecamatan->latitude) && !empty($record->kecamatan->longitude))
                            ? 'Kecamatan memiliki koordinat'
                            : 'Kecamatan belum memiliki koordinat'
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (Desa $record): string =>
                        $record->created_at->diffForHumans()
                    ),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-o-clock')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (Desa $record): string =>
                        $record->updated_at->diffForHumans()
                    ),
            ])
            ->defaultSort('nama_desa', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->label('Filter Kecamatan')
                    ->placeholder('Semua Kecamatan')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Kecamatan'),

                Tables\Filters\Filter::make('with_coordinates')
                    ->label('Kecamatan Dengan Koordinat')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereHas('kecamatan', function (Builder $q) {
                            $q->whereNotNull('latitude')->whereNotNull('longitude');
                        })
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('without_coordinates')
                    ->label('Kecamatan Tanpa Koordinat')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereHas('kecamatan', function (Builder $q) {
                            $q->whereNull('latitude')->orWhereNull('longitude');
                        })
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dibuat Dari')
                            ->placeholder('Tanggal mulai'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Dibuat Sampai')
                            ->placeholder('Tanggal akhir'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = 'Dari: ' . \Carbon\Carbon::parse($data['created_from'])->format('d M Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = 'Sampai: ' . \Carbon\Carbon::parse($data['created_until'])->format('d M Y');
                        }
                        return $indicators;
                    }),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
            ->persistFiltersInSession()
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->color('warning'),

                    Tables\Actions\Action::make('view_kecamatan')
                        ->label('Lihat Kecamatan')
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->color('success')
                        ->url(fn (Desa $record): string =>
                            route('filament.admin.resources.kecamatans.view', ['record' => $record->kecamatan_id])
                        ),

                    Tables\Actions\Action::make('view_map')
                        ->label('Lihat di Peta')
                        ->icon('heroicon-o-map')
                        ->color('primary')
                        ->url(fn (Desa $record): string =>
                            $record->kecamatan->latitude && $record->kecamatan->longitude
                                ? "https://www.google.com/maps?q={$record->kecamatan->latitude},{$record->kecamatan->longitude}&z=14"
                                : '#'
                        )
                        ->openUrlInNewTab()
                        ->visible(fn (Desa $record): bool =>
                            !empty($record->kecamatan->latitude) && !empty($record->kecamatan->longitude)
                        ),

                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Desa/Kelurahan')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data desa/kelurahan terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('change_kecamatan')
                        ->label('Pindahkan Kecamatan')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('kecamatan_id')
                                ->label('Kecamatan Baru')
                                ->relationship('kecamatan', 'nama_kecamatan')
                                ->required()
                                ->searchable()
                                ->preload(),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->update(['kecamatan_id' => $data['kecamatan_id']]);
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Pindahkan ke Kecamatan Lain')
                        ->modalDescription('Pilih kecamatan tujuan untuk desa/kelurahan yang dipilih')
                        ->modalSubmitActionLabel('Pindahkan')
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('export')
                        ->label('Export Data')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            // Add your export logic here
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Data Desa/Kelurahan')
            ->emptyStateDescription('Silakan tambahkan data desa atau kelurahan terlebih dahulu')
            ->emptyStateIcon('heroicon-o-home-modern')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Desa/Kelurahan')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100, 'all'])
            ->poll('30s')
            ->deferLoading()
            ->persistSearchInSession()
            ->persistSortInSession()
            ->persistColumnSearchesInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Desa/Kelurahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Components\TextEntry::make('nama_desa')
                            ->label('Nama Desa/Kelurahan')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-home-modern')
                            ->copyable()
                            ->color('primary'),
                    ]),

                Components\Section::make('Wilayah Administratif')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Components\TextEntry::make('kecamatan.nama_kecamatan')
                            ->label('Kecamatan')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-map-pin')
                            ->url(fn (Desa $record): string =>
                                route('filament.admin.resources.kecamatans.view', ['record' => $record->kecamatan_id])
                            ),

                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('kecamatan.latitude')
                                    ->label('Latitude Kecamatan')
                                    ->icon('heroicon-o-arrow-up-down')
                                    ->badge()
                                    ->color('info')
                                    ->default('-'),

                                Components\TextEntry::make('kecamatan.longitude')
                                    ->label('Longitude Kecamatan')
                                    ->icon('heroicon-o-arrow-left-right')
                                    ->badge()
                                    ->color('warning')
                                    ->default('-'),
                            ]),
                    ]),

                Components\Section::make('Informasi Timestamp')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-calendar')
                                    ->description(fn (Desa $record): string =>
                                        $record->created_at->diffForHumans()
                                    ),

                                Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-arrow-path')
                                    ->description(fn (Desa $record): string =>
                                        $record->updated_at->diffForHumans()
                                    ),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Aksi Cepat')
                    ->icon('heroicon-o-bolt')
                    ->schema([
                        Components\Actions::make([
                            Components\Actions\Action::make('view_kecamatan')
                                ->label('Lihat Detail Kecamatan')
                                ->icon('heroicon-o-arrow-top-right-on-square')
                                ->color('success')
                                ->url(fn (Desa $record): string =>
                                    route('filament.admin.resources.kecamatans.view', ['record' => $record->kecamatan_id])
                                ),

                            Components\Actions\Action::make('view_map')
                                ->label('Buka di Google Maps')
                                ->icon('heroicon-o-map')
                                ->color('primary')
                                ->url(fn (Desa $record): string =>
                                    $record->kecamatan->latitude && $record->kecamatan->longitude
                                        ? "https://www.google.com/maps?q={$record->kecamatan->latitude},{$record->kecamatan->longitude}&z=14"
                                        : '#'
                                )
                                ->openUrlInNewTab()
                                ->visible(fn (Desa $record): bool =>
                                    !empty($record->kecamatan->latitude) && !empty($record->kecamatan->longitude)
                                ),
                        ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDesas::route('/'),
            'create' => Pages\CreateDesa::route('/create'),
            'view' => Pages\ViewDesa::route('/{record}'),
            'edit' => Pages\EditDesa::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::count();
        if ($count > 50) return 'success';
        if ($count > 20) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->nama_desa;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Kecamatan' => $record->kecamatan->nama_kecamatan,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_desa', 'kecamatan.nama_kecamatan'];
    }
}
