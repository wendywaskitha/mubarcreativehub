<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KecamatanResource\Pages;
use App\Filament\Resources\KecamatanResource\RelationManagers;
use App\Models\Kecamatan;
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

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Kecamatan';

    protected static ?string $modelLabel = 'Kecamatan';

    protected static ?string $pluralModelLabel = 'Data Kecamatan';

    protected static ?string $navigationGroup = 'Wilayah Administratif';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama_kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kecamatan')
                    ->description('Masukkan data kecamatan dengan lengkap')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kecamatan')
                            ->label('Nama Kecamatan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Kecamatan Wangi-Wangi')
                            ->prefixIcon('heroicon-o-map')
                            ->columnSpanFull()
                            ->autocomplete(false)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('nama_kecamatan', ucwords(strtolower($state)));
                            }),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Koordinat Geografis')
                    ->description('Tentukan lokasi koordinat kecamatan untuk pemetaan digital')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude (Garis Lintang)')
                                    ->numeric()
                                    ->placeholder('-5.1667')
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Koordinat Utara-Selatan (format desimal)')
                                    ->step(0.000001)
                                    ->minValue(-90)
                                    ->maxValue(90)
                                    ->suffix('°')
                                    ->reactive(),

                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude (Garis Bujur)')
                                    ->numeric()
                                    ->placeholder('122.6667')
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->helperText('Koordinat Barat-Timur (format desimal)')
                                    ->step(0.000001)
                                    ->minValue(-180)
                                    ->maxValue(180)
                                    ->suffix('°')
                                    ->reactive(),
                            ]),

                        Forms\Components\Placeholder::make('map_info')
                            ->label('')
                            ->content(fn ($get) =>
                                $get('latitude') && $get('longitude')
                                    ? '📍 Koordinat: ' . $get('latitude') . ', ' . $get('longitude')
                                    : '💡 Tips: Gunakan Google Maps untuk mendapatkan koordinat yang akurat'
                            )
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('nama_kecamatan')
                    ->label('Nama Kecamatan')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-map-pin')
                    ->iconColor('primary')
                    ->weight(FontWeight::SemiBold)
                    ->description(fn (Kecamatan $record): string =>
                        $record->desa_count
                            ? $record->desa_count . ' Desa/Kelurahan'
                            : 'Belum ada desa'
                    )
                    ->copyable()
                    ->copyMessage('Nama kecamatan disalin!')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitude')
                    ->numeric(decimalPlaces: 6)
                    ->sortable()
                    ->alignCenter()
                    ->icon('heroicon-o-arrows-up-down')
                    ->color('success')
                    ->badge()
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitude')
                    ->numeric(decimalPlaces: 6)
                    ->sortable()
                    ->alignCenter()
                    ->icon('heroicon-o-arrows-up-down')
                    ->color('info')
                    ->badge()
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\IconColumn::make('has_coordinates')
                    ->label('Status Koordinat')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->getStateUsing(fn (Kecamatan $record): bool =>
                        !empty($record->latitude) && !empty($record->longitude)
                    )
                    ->tooltip(fn (Kecamatan $record): string =>
                        (!empty($record->latitude) && !empty($record->longitude))
                            ? 'Koordinat tersedia'
                            : 'Koordinat belum diisi'
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (Kecamatan $record): string =>
                        $record->created_at->diffForHumans()
                    ),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-o-clock')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (Kecamatan $record): string =>
                        $record->updated_at->diffForHumans()
                    ),
            ])
            ->defaultSort('nama_kecamatan', 'asc')
            ->filters([
                Tables\Filters\Filter::make('has_coordinates')
                    ->label('Dengan Koordinat')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('latitude')
                              ->whereNotNull('longitude')
                    )
                    ->toggle()
                    ->default(false),

                Tables\Filters\Filter::make('without_coordinates')
                    ->label('Tanpa Koordinat')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNull('latitude')
                              ->orWhereNull('longitude')
                    )
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->color('warning'),

                    Tables\Actions\Action::make('view_map')
                        ->label('Lihat Peta')
                        ->icon('heroicon-o-map')
                        ->color('success')
                        ->url(fn (Kecamatan $record): string =>
                            $record->latitude && $record->longitude
                                ? "https://www.google.com/maps?q={$record->latitude},{$record->longitude}"
                                : '#'
                        )
                        ->openUrlInNewTab()
                        ->visible(fn (Kecamatan $record): bool =>
                            !empty($record->latitude) && !empty($record->longitude)
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
                        ->modalHeading('Hapus Data Kecamatan')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data kecamatan terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('export_coordinates')
                        ->label('Export Koordinat')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->requiresConfirmation(false)
                        ->action(function ($records) {
                            // Add your export logic here
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Data Kecamatan')
            ->emptyStateDescription('Silakan tambahkan data kecamatan terlebih dahulu')
            ->emptyStateIcon('heroicon-o-map')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Kecamatan')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Kecamatan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Components\TextEntry::make('nama_kecamatan')
                            ->label('Nama Kecamatan')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-map-pin')
                            ->copyable(),
                    ]),

                Components\Section::make('Koordinat Geografis')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('latitude')
                                    ->label('Latitude')
                                    ->icon('heroicon-o-arrows-up-down')
                                    ->badge()
                                    ->color('success')
                                    ->default('-'),

                                Components\TextEntry::make('longitude')
                                    ->label('Longitude')
                                    ->icon('heroicon-o-arrows-up-down')
                                    ->badge()
                                    ->color('info')
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
                                    ->icon('heroicon-o-calendar'),

                                Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-arrow-path'),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DesaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'view' => Pages\ViewKecamatan::route('/{record}'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }
}
