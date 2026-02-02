<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Banner;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BannerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerResource\RelationManagers;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Banner';

    protected static ?string $modelLabel = 'Banner';

    protected static ?string $pluralModelLabel = 'Banner Slider';

    protected static ?string $navigationGroup = 'Konten & Media';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Konten Banner')
                            ->description('Judul dan subtitle yang akan ditampilkan di banner')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Banner')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Selamat Datang di Portal UMKM')
                                    ->prefixIcon('heroicon-o-megaphone')
                                    ->autocomplete(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        $set('judul', ucwords(strtolower($state)));
                                    })
                                    ->columnSpanFull()
                                    ->helperText('Judul utama yang akan ditampilkan (maksimal 255 karakter)'),

                                Forms\Components\Textarea::make('subtitle')
                                    ->label('Subtitle/Deskripsi')
                                    ->maxLength(500)
                                    ->rows(3)
                                    ->placeholder('Tambahkan deskripsi atau kalimat pendukung...')
                                    ->columnSpanFull()
                                    ->helperText('Teks pendukung di bawah judul (opsional, maksimal 500 karakter)'),

                                Forms\Components\Placeholder::make('preview_text')
                                    ->label('Preview Teks')
                                    ->content(function (Forms\Get $get) {
                                        $judul = $get('judul') ?? 'Judul Banner Anda';
                                        $subtitle = $get('subtitle') ?? 'Subtitle banner Anda';

                                        return new \Illuminate\Support\HtmlString(
                                            '<div class="p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border-2 border-blue-200">
                                                <h2 class="text-3xl font-bold text-gray-800 mb-2">' . $judul . '</h2>
                                                <p class="text-gray-600 text-lg">' . $subtitle . '</p>
                                            </div>'
                                        );
                                    })
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Tombol Call-to-Action')
                            ->description('Konfigurasi tombol aksi pada banner')
                            ->icon('heroicon-o-cursor-arrow-rays')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('button_text')
                                            ->label('Teks Tombol')
                                            ->maxLength(50)
                                            ->placeholder('Contoh: Lihat Katalog, Selengkapnya')
                                            ->prefixIcon('heroicon-o-hand-raised')
                                            ->helperText('Teks pada tombol (maksimal 50 karakter)')
                                            ->live(),

                                        Forms\Components\TextInput::make('button_link')
                                            ->label('Link Tujuan')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://example.com atau /produk')
                                            ->prefixIcon('heroicon-o-link')
                                            ->helperText('URL yang dituju saat tombol diklik')
                                            ->live(),
                                    ]),

                                Forms\Components\Select::make('button_style')
                                    ->label('Style Tombol')
                                    ->options([
                                        'primary' => 'Primary (Biru)',
                                        'secondary' => 'Secondary (Abu-abu)',
                                        'success' => 'Success (Hijau)',
                                        'warning' => 'Warning (Kuning)',
                                        'danger' => 'Danger (Merah)',
                                        'info' => 'Info (Cyan)',
                                    ])
                                    ->default('primary')
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-swatch')
                                    ->helperText('Warna tema tombol')
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('button_new_tab')
                                    ->label('Buka di Tab Baru')
                                    ->helperText('Link akan terbuka di tab/window baru')
                                    ->default(false)
                                    ->inline(false)
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('button_preview')
                                    ->label('Preview Tombol')
                                    ->content(function (Forms\Get $get) {
                                        $text = $get('button_text') ?? 'Tombol Aksi';
                                        $style = $get('button_style') ?? 'primary';

                                        $colors = [
                                            'primary' => 'bg-blue-600 hover:bg-blue-700',
                                            'secondary' => 'bg-gray-600 hover:bg-gray-700',
                                            'success' => 'bg-green-600 hover:bg-green-700',
                                            'warning' => 'bg-yellow-600 hover:bg-yellow-700',
                                            'danger' => 'bg-red-600 hover:bg-red-700',
                                            'info' => 'bg-cyan-600 hover:bg-cyan-700',
                                        ];

                                        $colorClass = $colors[$style] ?? $colors['primary'];

                                        return new \Illuminate\Support\HtmlString(
                                            '<button class="px-6 py-3 ' . $colorClass . ' text-white font-semibold rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                                                ' . $text . '
                                            </button>'
                                        );
                                    })
                                    ->columnSpanFull()
                                    ->visible(fn (Forms\Get $get) => !empty($get('button_text'))),
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Gambar Banner Desktop')
                            ->description('Gambar untuk tampilan desktop/laptop (Rekomendasi: 1920x600px)')
                            ->icon('heroicon-o-computer-desktop')
                            ->schema([
                                Forms\Components\FileUpload::make('image_desktop')
                                    ->label('Upload Gambar Desktop')
                                    ->image()
                                    ->maxSize(5120)
                                    ->directory('banner-images')
                                    ->required()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '21:9',
                                        '3:1',
                                    ])
                                    ->helperText('Format: JPG, PNG (Max: 5MB)')
                                    ->columnSpanFull()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1920')
                                    ->imageResizeTargetHeight('600'),

                                Forms\Components\Placeholder::make('desktop_info')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString(
                                        '<div class="text-xs text-gray-500 space-y-1 bg-blue-50 p-3 rounded-lg">
                                            <p class="font-semibold text-blue-800">📐 Rekomendasi Ukuran Desktop:</p>
                                            <ul class="list-disc list-inside space-y-1 ml-2">
                                                <li><strong>Optimal:</strong> 1920 x 600 pixels (16:9)</li>
                                                <li><strong>Alternatif:</strong> 1920 x 800 pixels</li>
                                                <li><strong>Format:</strong> JPG atau PNG</li>
                                                <li><strong>Ukuran File:</strong> Maksimal 5MB</li>
                                            </ul>
                                        </div>'
                                    ))
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Gambar Banner Mobile')
                            ->description('Gambar untuk tampilan mobile/tablet (Rekomendasi: 768x1024px)')
                            ->icon('heroicon-o-device-phone-mobile')
                            ->schema([
                                Forms\Components\FileUpload::make('image_mobile')
                                    ->label('Upload Gambar Mobile (Opsional)')
                                    ->image()
                                    ->maxSize(5120)
                                    ->directory('banner-images')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '3:4',
                                        '9:16',
                                        '2:3',
                                    ])
                                    ->helperText('Jika kosong, akan menggunakan gambar desktop')
                                    ->columnSpanFull()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->imageCropAspectRatio('3:4')
                                    ->imageResizeTargetWidth('768')
                                    ->imageResizeTargetHeight('1024'),

                                Forms\Components\Placeholder::make('mobile_info')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString(
                                        '<div class="text-xs text-gray-500 space-y-1 bg-green-50 p-3 rounded-lg">
                                            <p class="font-semibold text-green-800">📱 Rekomendasi Ukuran Mobile:</p>
                                            <ul class="list-disc list-inside space-y-1 ml-2">
                                                <li><strong>Optimal:</strong> 768 x 1024 pixels (3:4)</li>
                                                <li><strong>Alternatif:</strong> 720 x 1280 pixels (9:16)</li>
                                                <li><strong>Format:</strong> JPG atau PNG</li>
                                                <li><strong>Note:</strong> Opsional, gunakan orientasi portrait</li>
                                            </ul>
                                        </div>'
                                    ))
                                    ->columnSpanFull(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Pengaturan Tampilan')
                            ->description('Urutan dan status aktif banner')
                            ->icon('heroicon-o-adjustments-horizontal')
                            ->schema([
                                Forms\Components\TextInput::make('order')
                                    ->label('Urutan Prioritas')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->placeholder('0')
                                    ->prefixIcon('heroicon-o-bars-3')
                                    ->helperText('Angka kecil = prioritas tinggi (muncul lebih dulu)')
                                    ->suffix('Urutan')
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->helperText('Aktifkan untuk menampilkan banner di website')
                                    ->default(true)
                                    ->inline(false)
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('status_info')
                                    ->label('Status Tampilan')
                                    ->content(function (Forms\Get $get) {
                                        $active = $get('is_active');
                                        $order = $get('order') ?? 0;

                                        return new \Illuminate\Support\HtmlString(
                                            '<div class="space-y-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-3 h-3 rounded-full ' . ($active ? 'bg-green-500' : 'bg-red-500') . '"></span>
                                                    <span class="text-sm font-semibold">' . ($active ? '✅ Banner Aktif' : '❌ Banner Nonaktif') . '</span>
                                                </div>
                                                <div class="text-sm text-gray-600">
                                                    🔢 Urutan: <strong>#' . $order . '</strong>
                                                </div>
                                            </div>'
                                        );
                                    })
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->alignCenter()
                    ->weight(FontWeight::Bold)
                    ->color('primary')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::Large),

                Tables\Columns\ImageColumn::make('image_desktop')
                    ->label('Preview')
                    ->size(80)
                    ->defaultImageUrl(url('/images/default-banner.png')),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-o-megaphone')
                    ->iconColor('primary')
                    ->copyable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->color('gray')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::Small)
                    ->limit(60)
                    ->default('-'),

                Tables\Columns\TextColumn::make('button_text')
                    ->label('Tombol CTA')
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-cursor-arrow-rays')
                    ->default('-')
                    ->formatStateUsing(fn ($state) => $state ? '🔘 ' . $state : '-'),

                Tables\Columns\IconColumn::make('has_mobile_image')
                    ->label('Mobile')
                    ->boolean()
                    ->trueIcon('heroicon-o-device-phone-mobile')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->getStateUsing(fn (Banner $record): bool => !empty($record->image_mobile))
                    ->tooltip(fn (Banner $record): string =>
                        !empty($record->image_mobile) ? 'Ada gambar mobile' : 'Tidak ada gambar mobile'
                    ),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->sortable()
                    ->tooltip(fn (Banner $record): string =>
                        $record->is_active ? 'Banner Aktif' : 'Banner Nonaktif'
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->description(fn (Banner $record): string =>
                        $record->created_at->diffForHumans()
                    )
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-o-clock')
                    ->description(fn (Banner $record): string =>
                        $record->updated_at->diffForHumans()
                    )
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Banner')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif Saja')
                    ->falseLabel('Nonaktif Saja')
                    ->indicator('Status'),

                Tables\Filters\Filter::make('has_button')
                    ->label('Memiliki Tombol CTA')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('button_text')
                              ->where('button_text', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('has_mobile_image')
                    ->label('Memiliki Gambar Mobile')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('image_mobile')
                              ->where('image_mobile', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dibuat Dari'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Dibuat Sampai'),
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
                    }),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->persistFiltersInSession()
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->color('warning'),

                    Tables\Actions\Action::make('toggle_active')
                        ->label(fn (Banner $record) => $record->is_active ? 'Nonaktifkan' : 'Aktifkan')
                        ->icon(fn (Banner $record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                        ->color(fn (Banner $record) => $record->is_active ? 'danger' : 'success')
                        ->requiresConfirmation()
                        ->action(function (Banner $record) {
                            $record->update(['is_active' => !$record->is_active]);
                        })
                        ->successNotificationTitle('Status banner diperbarui'),

                    Tables\Actions\Action::make('duplicate')
                        ->label('Duplikat Banner')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->action(function (Banner $record) {
                            $newBanner = $record->replicate();
                            $newBanner->judul = $record->judul . ' (Copy)';
                            $newBanner->is_active = false;
                            $newBanner->order = Banner::max('order') + 1;
                            $newBanner->save();
                        })
                        ->successNotificationTitle('Banner berhasil diduplikat'),

                    Tables\Actions\Action::make('preview')
                        ->label('Preview')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->url(fn (Banner $record) =>
                            $record->image_desktop
                                ? Storage::url($record->image_desktop)
                                : '#'
                        )
                        ->openUrlInNewTab(),

                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Banner')
                        ->modalDescription('Apakah Anda yakin ingin menghapus banner terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => true]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => false]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('reorder')
                        ->label('Atur Ulang Urutan')
                        ->icon('heroicon-o-bars-3')
                        ->color('primary')
                        ->form([
                            Forms\Components\TextInput::make('start_order')
                                ->label('Mulai dari Urutan')
                                ->numeric()
                                ->required()
                                ->default(1),
                        ])
                        ->action(function (array $data, $records) {
                            $order = $data['start_order'];
                            foreach ($records as $record) {
                                $record->update(['order' => $order++]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Banner')
            ->emptyStateDescription('Mulai buat banner slider untuk halaman depan website')
            ->emptyStateIcon('heroicon-o-photo')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Banner')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50])
            ->poll('60s')
            ->persistSearchInSession()
            ->persistSortInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Preview Banner')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Components\View::make('filament.infolists.banner-preview')
                            ->columnSpanFull(),
                    ]),

                Components\Section::make('Informasi Banner')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('judul')
                                    ->label('Judul Banner')
                                    ->size(Components\TextEntry\TextEntrySize::Large)
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-o-megaphone')
                                    ->copyable()
                                    ->color('primary')
                                    ->columnSpanFull(),

                                Components\TextEntry::make('subtitle')
                                    ->label('Subtitle/Deskripsi')
                                    ->icon('heroicon-o-document-text')
                                    ->default('-')
                                    ->columnSpanFull(),

                                Components\TextEntry::make('order')
                                    ->label('Urutan Prioritas')
                                    ->badge()
                                    ->color('primary')
                                    ->icon('heroicon-o-bars-3')
                                    ->prefix('#'),

                                Components\IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                            ]),
                    ]),

                Components\Section::make('Call-to-Action Button')
                    ->icon('heroicon-o-cursor-arrow-rays')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('button_text')
                                    ->label('Teks Tombol')
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-o-hand-raised')
                                    ->default('-'),

                                Components\TextEntry::make('button_link')
                                    ->label('Link Tujuan')
                                    ->icon('heroicon-o-link')
                                    ->copyable()
                                    ->url(fn (Banner $record) => $record->button_link ?? '#')
                                    ->openUrlInNewTab()
                                    ->default('-'),

                                Components\TextEntry::make('button_style')
                                    ->label('Style Tombol')
                                    ->badge()
                                    ->color(fn ($state) => match($state) {
                                        'primary' => 'primary',
                                        'success' => 'success',
                                        'warning' => 'warning',
                                        'danger' => 'danger',
                                        'info' => 'info',
                                        default => 'gray',
                                    })
                                    ->default('primary'),
                            ]),
                    ])
                    ->visible(fn (Banner $record) => !empty($record->button_text))
                    ->collapsible(),

                Components\Section::make('Gambar Banner')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\ImageEntry::make('image_desktop')
                                    ->label('Gambar Desktop')
                                    ->defaultImageUrl(url('/images/default-banner.png'))
                                    ->columnSpan(1),

                                Components\ImageEntry::make('image_mobile')
                                    ->label('Gambar Mobile')
                                    ->defaultImageUrl(url('/images/default-banner-mobile.png'))
                                    ->columnSpan(1)
                                    ->visible(fn (Banner $record) => !empty($record->image_mobile)),
                            ]),
                    ]),

                Components\Section::make('Informasi Sistem')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-calendar')
                                    ->formatStateUsing(fn (Banner $record) =>
                                        $record->created_at->format('d F Y, H:i:s') .
                                        ' (' . $record->created_at->diffForHumans() . ')'
                                    ),
                                Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-arrow-path')
                                    ->formatStateUsing(fn (Banner $record) =>
                                        $record->updated_at->format('d F Y, H:i:s') .
                                        ' (' . $record->updated_at->diffForHumans() . ')'
                                    ),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'view' => Pages\ViewBanner::route('/{record}'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('is_active', true)->count();
        if ($count >= 5) return 'success';
        if ($count >= 3) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->judul;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Subtitle' => $record->subtitle ?? '-',
            'Urutan' => '#' . $record->order,
            'Status' => $record->is_active ? 'Aktif' : 'Nonaktif',
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['judul', 'subtitle', 'button_text'];
    }
}
