<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
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
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk Pelaku Ekraf';

    protected static ?string $navigationGroup = 'Ekonomi Kreatif';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'nama_produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Produk')
                            ->description('Data dasar produk UMKM')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Select::make('umkm_id')
                                    ->label('Pemilik')
                                    ->relationship('umkm', 'nama_usaha')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-building-storefront')
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('nama_usaha')
                                            ->required(),
                                        Forms\Components\TextInput::make('nama_pemilik')
                                            ->required(),
                                        Forms\Components\Select::make('subsektor_id')
                                            ->relationship('subsektor', 'nama_subsektor')
                                            ->required(),
                                    ])
                                    ->createOptionModalHeading('Tambah UMKM Baru')
                                    ->live()
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        if ($state) {
                                            $umkm = \App\Models\UMKM::find($state);
                                            // Auto-fill kategori based on subsektor
                                        }
                                    })
                                    ->helperText('Pilih UMKM pemilik produk'),

                                Forms\Components\TextInput::make('nama_produk')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Batik Tulis Motif Wakatobi')
                                    ->prefixIcon('heroicon-o-shopping-bag')
                                    ->autocomplete(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                        if (!$get('slug')) {
                                            $set('slug', Str::slug($state));
                                        }
                                        $set('nama_produk', ucwords(strtolower($state)));
                                    })
                                    ->unique(ignoreRecord: true)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('batik-tulis-motif-wakatobi')
                                    ->prefixIcon('heroicon-o-link')
                                    ->prefix(url('/produk/'))
                                    ->helperText('URL ramah SEO (otomatis dari nama produk)')
                                    ->unique(ignoreRecord: true)
                                    ->alphaDash()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('kategori')
                                    ->label('Kategori Produk')
                                    ->options([
                                        'Fashion & Tekstil' => 'Fashion & Tekstil',
                                        'Makanan & Kue' => 'Makanan & Kue',
                                        'Minuman' => 'Minuman',
                                        'Kerajinan Tangan' => 'Kerajinan Tangan',
                                        'Furniture' => 'Furniture',
                                        'Aksesoris' => 'Aksesoris',
                                        'Souvenir & Oleh-oleh' => 'Souvenir & Oleh-oleh',
                                        'Seni & Lukisan' => 'Seni & Lukisan',
                                        'Tas & Dompet' => 'Tas & Dompet',
                                        'Sepatu & Sandal' => 'Sepatu & Sandal',
                                        'Kosmetik & Perawatan' => 'Kosmetik & Perawatan',
                                        'Elektronik' => 'Elektronik',
                                        'Lainnya' => 'Lainnya',
                                    ])
                                    ->placeholder('Pilih Kategori')
                                    ->native(false)
                                    ->searchable()
                                    ->prefixIcon('heroicon-o-tag')
                                    ->helperText('Kategori untuk memudahkan pencarian'),

                                Forms\Components\TagsInput::make('tags')
                                    ->label('Tags/Label')
                                    ->placeholder('Tekan Enter untuk menambah tag')
                                    ->helperText('Tag untuk SEO dan filter (contoh: handmade, premium, eksklusif)')
                                    ->suggestions([
                                        'Handmade',
                                        'Premium',
                                        'Eksklusif',
                                        'Limited Edition',
                                        'Best Seller',
                                        'Trending',
                                        'Lokal',
                                        'Organik',
                                        'Halal',
                                        'Ramah Lingkungan',
                                    ])
                                    ->separator(',')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Deskripsi Produk')
                            ->description('Deskripsi lengkap dan menarik untuk produk')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\RichEditor::make('deskripsi')
                                    ->label('Deskripsi Lengkap')
                                    ->placeholder('Ceritakan detail produk, bahan, keunggulan, cara perawatan, dll...')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'redo',
                                        'undo',
                                    ])
                                    ->columnSpanFull()
                                    ->helperText('Format teks dengan bold, italic, list untuk deskripsi yang menarik'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([

                        Forms\Components\Section::make('Status Produk')
                            ->description('Pengaturan tampil dan unggulan')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Toggle::make('status_tersedia')
                                    ->label('Tersedia untuk Dijual')
                                    ->helperText('Produk dapat dilihat dan dibeli')
                                    ->default(true)
                                    ->inline(false)
                                    ->live()
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Produk Unggulan')
                                    ->helperText('Tampilkan di halaman utama')
                                    ->default(false)
                                    ->inline(false)
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('product_status')
                                    ->label('Status Tampilan')
                                    ->content(function (Forms\Get $get) {
                                        $tersedia = $get('status_tersedia');
                                        $featured = $get('is_featured');

                                        return new \Illuminate\Support\HtmlString(
                                            '<div class="space-y-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-3 h-3 rounded-full ' . ($tersedia ? 'bg-green-500' : 'bg-gray-300') . '"></span>
                                                    <span class="text-sm">' . ($tersedia ? 'Tampil di Katalog' : 'Tidak Tampil') . '</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="w-3 h-3 rounded-full ' . ($featured ? 'bg-yellow-500' : 'bg-gray-300') . '"></span>
                                                    <span class="text-sm">' . ($featured ? '⭐ Produk Unggulan' : 'Produk Biasa') . '</span>
                                                </div>
                                            </div>'
                                        );
                                    })
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Galeri Produk')
                            ->description('Upload hingga 5 foto produk')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('foto_1')
                                    ->label('Foto Utama')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        '4:3',
                                        '16:9',
                                    ])
                                    ->helperText('Foto utama produk (Maks. 2MB)')
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('foto_2')
                                    ->label('Foto 2')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageEditor()
                                    ->helperText('Foto tambahan')
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('foto_3')
                                    ->label('Foto 3')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageEditor()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('foto_4')
                                    ->label('Foto 4')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageEditor()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('foto_5')
                                    ->label('Foto 5')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageEditor()
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('foto_info')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString(
                                        '<div class="text-xs text-gray-500 space-y-1">
                                            <p>💡 <strong>Tips Foto Produk:</strong></p>
                                            <ul class="list-disc list-inside space-y-1 ml-2">
                                                <li>Gunakan pencahayaan yang baik</li>
                                                <li>Foto dari berbagai sudut</li>
                                                <li>Tampilkan detail produk</li>
                                                <li>Background bersih dan rapi</li>
                                                <li>Resolusi minimal 800x800px</li>
                                            </ul>
                                        </div>'
                                    ))
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
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex()
                    ->alignCenter(),

                Tables\Columns\ImageColumn::make('foto_1')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-product.png'))
                    ->size(50),

                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-o-shopping-bag')
                    ->iconColor('primary')
                    ->description(fn (Produk $record): string =>
                        $record->umkm->nama_usaha ?? '-'
                    )
                    ->copyable()
                    ->copyMessage('Nama produk disalin!')
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('umkm.nama_usaha')
                    ->label('Pelaku Ekraf')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-building-storefront')
                    ->url(fn (Produk $record): string =>
                        route('filament.admin.resources.u-m-k-m-s.view', ['record' => $record->umkm_id])
                    )
                    ->tooltip('Klik untuk lihat detail UMKM')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-o-tag')
                    ->searchable()
                    ->toggleable(),



                Tables\Columns\IconColumn::make('status_tersedia')
                    ->label('Tersedia')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->sortable()
                    ->tooltip(fn (Produk $record): string =>
                        $record->status_tersedia ? 'Produk Tersedia' : 'Produk Tidak Tersedia'
                    ),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->sortable()
                    ->tooltip(fn (Produk $record): string =>
                        $record->is_featured ? '⭐ Produk Unggulan' : 'Produk Biasa'
                    ),

                Tables\Columns\TextColumn::make('tags')
                    ->label('Tags')
                    ->badge()
                    ->separator(',')
                    ->color('info')
                    ->limit(2)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->description(fn (Produk $record): string =>
                        $record->created_at->diffForHumans()
                    )
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('umkm')
                    ->relationship('umkm', 'nama_usaha')
                    ->label('UMKM')
                    ->placeholder('Semua UMKM')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('UMKM'),

                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Fashion & Tekstil' => 'Fashion & Tekstil',
                        'Makanan & Kue' => 'Makanan & Kue',
                        'Minuman' => 'Minuman',
                        'Kerajinan Tangan' => 'Kerajinan Tangan',
                        'Furniture' => 'Furniture',
                        'Aksesoris' => 'Aksesoris',
                        'Souvenir & Oleh-oleh' => 'Souvenir & Oleh-oleh',
                        'Seni & Lukisan' => 'Seni & Lukisan',
                        'Tas & Dompet' => 'Tas & Dompet',
                        'Sepatu & Sandal' => 'Sepatu & Sandal',
                        'Kosmetik & Perawatan' => 'Kosmetik & Perawatan',
                        'Elektronik' => 'Elektronik',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->label('Kategori')
                    ->multiple()
                    ->searchable(),

                Tables\Filters\TernaryFilter::make('status_tersedia')
                    ->label('Status Tersedia')
                    ->placeholder('Semua Status')
                    ->trueLabel('Tersedia')
                    ->falseLabel('Tidak Tersedia')
                    ->indicator('Status'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Produk Unggulan')
                    ->placeholder('Semua Produk')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Biasa')
                    ->indicator('Unggulan'),


            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->persistFiltersInSession()
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->color('warning'),

                    Tables\Actions\Action::make('toggle_available')
                        ->label(fn (Produk $record) => $record->status_tersedia ? 'Sembunyikan' : 'Tampilkan')
                        ->icon(fn (Produk $record) => $record->status_tersedia ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                        ->color(fn (Produk $record) => $record->status_tersedia ? 'danger' : 'success')
                        ->requiresConfirmation()
                        ->action(function (Produk $record) {
                            $record->update(['status_tersedia' => !$record->status_tersedia]);
                        })
                        ->successNotificationTitle('Status produk diperbarui'),

                    Tables\Actions\Action::make('toggle_featured')
                        ->label(fn (Produk $record) => $record->is_featured ? 'Hapus Unggulan' : 'Jadikan Unggulan')
                        ->icon('heroicon-o-star')
                        ->color(fn (Produk $record) => $record->is_featured ? 'gray' : 'warning')
                        ->requiresConfirmation()
                        ->action(function (Produk $record) {
                            $record->update(['is_featured' => !$record->is_featured]);
                        })
                        ->successNotificationTitle('Status unggulan diperbarui'),

                    Tables\Actions\Action::make('duplicate')
                        ->label('Duplikat Produk')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->form([
                            Forms\Components\TextInput::make('nama_produk')
                                ->label('Nama Produk Baru')
                                ->required(),
                        ])
                        ->action(function (Produk $record, array $data) {
                            $newProduct = $record->replicate();
                            $newProduct->nama_produk = $data['nama_produk'];
                            $newProduct->slug = Str::slug($data['nama_produk']);
                            $newProduct->save();
                        })
                        ->successNotificationTitle('Produk berhasil diduplikat'),


                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Produk')
                        ->modalDescription('Apakah Anda yakin ingin menghapus produk terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('set_available')
                        ->label('Tampilkan Produk')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status_tersedia' => true]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('set_unavailable')
                        ->label('Sembunyikan Produk')
                        ->icon('heroicon-o-eye-slash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status_tersedia' => false]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('set_featured')
                        ->label('Jadikan Unggulan')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_featured' => true]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('change_category')
                        ->label('Ubah Kategori')
                        ->icon('heroicon-o-tag')
                        ->color('info')
                        ->form([
                            Forms\Components\Select::make('kategori')
                                ->label('Kategori Baru')
                                ->options([
                                    'Fashion & Tekstil' => 'Fashion & Tekstil',
                                    'Makanan & Kue' => 'Makanan & Kue',
                                    'Minuman' => 'Minuman',
                                    'Kerajinan Tangan' => 'Kerajinan Tangan',
                                    'Furniture' => 'Furniture',
                                    'Aksesoris' => 'Aksesoris',
                                    'Souvenir & Oleh-oleh' => 'Souvenir & Oleh-oleh',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required(),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->update(['kategori' => $data['kategori']]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('export')
                        ->label('Export Data')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('gray')
                        ->action(function ($records) {
                            // Add export logic
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Produk')
            ->emptyStateDescription('Mulai tambahkan produk UMKM untuk katalog Anda')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Produk')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('60s')
            ->deferLoading()
            ->persistSearchInSession()
            ->persistSortInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Preview Produk')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Components\Split::make([
                            Components\ImageEntry::make('foto_1')
                                ->label('')
                                ->defaultImageUrl(url('/images/default-product.png'))
                                ->size(200)
                                ->grow(false),

                            Components\Grid::make(2)
                                ->schema([
                                    Components\TextEntry::make('nama_produk')
                                        ->label('Nama Produk')
                                        ->size(Components\TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-o-shopping-bag')
                                        ->copyable()
                                        ->color('primary')
                                        ->columnSpanFull(),

                                    Components\TextEntry::make('umkm.nama_usaha')
                                        ->label('UMKM Pemilik')
                                        ->icon('heroicon-o-building-storefront')
                                        ->badge()
                                        ->color('success')
                                        ->url(fn (Produk $record): string =>
                                            route('filament.admin.resources.u-m-k-m-s.view', ['record' => $record->umkm_id])
                                        ),

                                    Components\TextEntry::make('kategori')
                                        ->label('Kategori')
                                        ->badge()
                                        ->color('gray')
                                        ->icon('heroicon-o-tag'),


                                ])
                                ->grow(true),
                        ]),
                    ]),

                Components\Section::make('Deskripsi Produk')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Components\TextEntry::make('deskripsi')
                            ->label('')
                            ->html()
                            ->columnSpanFull()
                            ->default('Belum ada deskripsi'),
                    ])
                    ->collapsible(),

                Components\Section::make('Galeri Foto')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Components\Grid::make(5)
                            ->schema([
                                Components\ImageEntry::make('foto_1')
                                    ->label('Foto 1')
                                    ->defaultImageUrl(url('/images/default-product.png')),
                                Components\ImageEntry::make('foto_2')
                                    ->label('Foto 2')
                                    ->defaultImageUrl(url('/images/default-product.png'))
                                    ->visible(fn (Produk $record) => !empty($record->foto_2)),
                                Components\ImageEntry::make('foto_3')
                                    ->label('Foto 3')
                                    ->defaultImageUrl(url('/images/default-product.png'))
                                    ->visible(fn (Produk $record) => !empty($record->foto_3)),
                                Components\ImageEntry::make('foto_4')
                                    ->label('Foto 4')
                                    ->defaultImageUrl(url('/images/default-product.png'))
                                    ->visible(fn (Produk $record) => !empty($record->foto_4)),
                                Components\ImageEntry::make('foto_5')
                                    ->label('Foto 5')
                                    ->defaultImageUrl(url('/images/default-product.png'))
                                    ->visible(fn (Produk $record) => !empty($record->foto_5)),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('slug')
                                    ->label('URL Slug')
                                    ->icon('heroicon-o-link')
                                    ->copyable()
                                    ->prefix(url('/produk/')),

                                Components\TextEntry::make('tags')
                                    ->label('Tags/Label')
                                    ->badge()
                                    ->separator(',')
                                    ->color('info')
                                    ->default('-'),

                                Components\TextEntry::make('umkm.subsektor.nama_subsektor')
                                    ->label('Subsektor')
                                    ->badge()
                                    ->color('purple')
                                    ->default('-'),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Status Produk')
                    ->icon('heroicon-o-check-badge')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\IconEntry::make('status_tersedia')
                                    ->label('Status Tersedia')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),

                                Components\IconEntry::make('is_featured')
                                    ->label('Produk Unggulan')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-star')
                                    ->falseIcon('heroicon-o-star')
                                    ->trueColor('warning')
                                    ->falseColor('gray'),
                            ]),
                    ]),

                Components\Section::make('Informasi Sistem')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('created_at')
                                    ->label('Ditambahkan')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-calendar'),

                                Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-arrow-path'),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'view' => Pages\ViewProduk::route('/{record}'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_tersedia', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('status_tersedia', true)->count();
        if ($count > 100) return 'success';
        if ($count > 50) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->nama_produk;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'UMKM' => $record->umkm->nama_usaha ?? '-',
            'Kategori' => $record->kategori ?? '-',
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_produk', 'kategori', 'tags', 'umkm.nama_usaha'];
    }
}
