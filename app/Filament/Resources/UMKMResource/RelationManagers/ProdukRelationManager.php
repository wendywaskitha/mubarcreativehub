<?php

namespace App\Filament\Resources\UMKMResource\RelationManagers;

use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Notifications\Notification;

class ProdukRelationManager extends RelationManager
{
    protected static string $relationship = 'produks';

    protected static ?string $title = 'Produk UMKM';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?string $recordTitleAttribute = 'nama_produk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Produk')
                    ->description('Masukkan informasi dasar tentang produk')
                    ->icon('heroicon-o-information-circle')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama_produk')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Keripik Singkong Original')
                                    ->helperText('Masukkan nama produk yang jelas dan menarik')
                                    ->columnSpan(2),

                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi Produk')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->placeholder('Deskripsikan produk Anda dengan detail...')
                                    ->helperText('Jelaskan keunggulan, bahan, dan informasi penting lainnya (max 1000 karakter)')
                                    ->columnSpan(2),
                            ]),
                    ]),

                Forms\Components\Section::make('Harga & Stok')
                    ->description('Kelola harga dan ketersediaan produk')
                    ->icon('heroicon-o-currency-dollar')
                    ->collapsible()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('harga')
                            ->label('Harga Jual')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->placeholder('0')
                            ->helperText('Harga dalam Rupiah')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $formatted = number_format($state, 0, ',', '.');
                                }
                            }),

                        Forms\Components\TextInput::make('stok')
                            ->label('Jumlah Stok')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->placeholder('0')
                            ->helperText('Jumlah unit tersedia')
                            ->suffix('unit'),

                        Forms\Components\Select::make('kategori')
                            ->label('Kategori Produk')
                            ->options([
                                'Makanan' => 'Makanan',
                                'Minuman' => 'Minuman',
                                'Fashion' => 'Fashion',
                                'Kerajinan Tangan' => 'Kerajinan Tangan',
                                'Aksesoris' => 'Aksesoris',
                                'Souvenir' => 'Souvenir',
                                'Produk Digital' => 'Produk Digital',
                                'Jasa' => 'Jasa',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->searchable()
                            ->placeholder('Pilih Kategori')
                            ->helperText('Pilih kategori yang sesuai'),
                    ]),

                Forms\Components\Section::make('Spesifikasi Produk')
                    ->description('Detail spesifikasi dan karakteristik produk (opsional)')
                    ->icon('heroicon-o-cube')
                    ->collapsible()
                    ->collapsed()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('berat')
                            ->label('Berat')
                            ->placeholder('500 gram')
                            ->maxLength(50)
                            ->helperText('Contoh: 500g, 1kg'),

                        Forms\Components\TextInput::make('ukuran')
                            ->label('Ukuran')
                            ->placeholder('20x30 cm')
                            ->maxLength(50)
                            ->helperText('Contoh: S, M, L atau dimensi'),

                        Forms\Components\TextInput::make('warna')
                            ->label('Warna')
                            ->placeholder('Merah, Biru')
                            ->maxLength(50)
                            ->helperText('Warna produk tersedia'),
                    ]),

                Forms\Components\Section::make('Tags & Status')
                    ->description('Tambahkan tags untuk memudahkan pencarian')
                    ->icon('heroicon-o-tag')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags Produk')
                            ->placeholder('Tambahkan tag...')
                            ->helperText('Tekan Enter untuk menambahkan tag')
                            ->suggestions([
                                'organik',
                                'halal',
                                'homemade',
                                'tradisional',
                                'modern',
                                'eksklusif',
                                'limited edition',
                                'best seller',
                                'new arrival',
                            ])
                            ->columnSpan(2),

                        Forms\Components\Toggle::make('status_tersedia')
                            ->label('Tersedia untuk Dijual')
                            ->default(true)
                            ->helperText('Aktifkan jika produk tersedia')
                            ->inline(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Produk Unggulan')
                            ->helperText('Tampilkan di halaman utama')
                            ->inline(false),
                    ]),

                Forms\Components\Section::make('Foto Produk')
                    ->description('Unggah minimal 1 foto produk (maksimal 5 foto)')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\FileUpload::make('foto_1')
                                    ->label('Foto Utama')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('768')
                                    ->helperText('Foto utama produk (max 2MB)')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                                Forms\Components\FileUpload::make('foto_2')
                                    ->label('Foto Tambahan 1')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('768')
                                    ->helperText('Foto tambahan (opsional)')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                                Forms\Components\FileUpload::make('foto_3')
                                    ->label('Foto Tambahan 2')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('768')
                                    ->helperText('Foto tambahan (opsional)')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                                Forms\Components\FileUpload::make('foto_4')
                                    ->label('Foto Tambahan 3')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('768')
                                    ->helperText('Foto tambahan (opsional)')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                                Forms\Components\FileUpload::make('foto_5')
                                    ->label('Foto Tambahan 4')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(2048)
                                    ->directory('produk-images')
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('768')
                                    ->helperText('Foto tambahan (opsional)')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                            ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_produk')
            ->columns([
                Tables\Columns\ImageColumn::make('foto_1')
                    ->label('Foto')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/images/placeholder-product.png')),

                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->description(fn (Produk $record): string => $record->kategori ?? '-')
                    ->wrap(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->weight(FontWeight::SemiBold)
                    ->color('success'),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->sortable()
                    ->suffix(' unit')
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state == 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\IconColumn::make('status_tersedia')
                    ->label('Tersedia')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Makanan' => 'Makanan',
                        'Minuman' => 'Minuman',
                        'Fashion' => 'Fashion',
                        'Kerajinan Tangan' => 'Kerajinan Tangan',
                        'Aksesoris' => 'Aksesoris',
                        'Souvenir' => 'Souvenir',
                        'Produk Digital' => 'Produk Digital',
                        'Jasa' => 'Jasa',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->multiple()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('status_tersedia')
                    ->label('Status Tersedia')
                    ->placeholder('Semua Produk')
                    ->trueLabel('Tersedia')
                    ->falseLabel('Tidak Tersedia')
                    ->native(false),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Produk Unggulan')
                    ->placeholder('Semua Produk')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Biasa')
                    ->native(false),

                Tables\Filters\Filter::make('stok_rendah')
                    ->label('Stok Rendah (≤ 10)')
                    ->query(fn (Builder $query): Builder => $query->where('stok', '<=', 10))
                    ->toggle(),

                Tables\Filters\Filter::make('stok_habis')
                    ->label('Stok Habis')
                    ->query(fn (Builder $query): Builder => $query->where('stok', 0))
                    ->toggle(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Produk')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Tambah Produk Baru')
                    ->modalDescription('Lengkapi informasi produk yang akan ditambahkan')
                    ->modalWidth('5xl')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Produk berhasil ditambahkan')
                            ->body('Produk baru telah ditambahkan ke katalog.')
                    ),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->modalWidth('5xl'),

                    Tables\Actions\EditAction::make()
                        ->modalHeading('Edit Produk')
                        ->modalDescription('Perbarui informasi produk')
                        ->modalWidth('5xl')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Produk berhasil diperbarui')
                                ->body('Informasi produk telah diperbarui.')
                        ),

                    Tables\Actions\Action::make('toggle_featured')
                        ->label(fn (Produk $record) => $record->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan')
                        ->icon(fn (Produk $record) => $record->is_featured ? 'heroicon-o-star' : 'heroicon-o-star')
                        ->color(fn (Produk $record) => $record->is_featured ? 'warning' : 'gray')
                        ->action(function (Produk $record) {
                            $record->update(['is_featured' => !$record->is_featured]);

                            Notification::make()
                                ->success()
                                ->title($record->is_featured ? 'Ditambahkan ke unggulan' : 'Dihapus dari unggulan')
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Konfirmasi Perubahan Status')
                        ->modalDescription(fn (Produk $record) => $record->is_featured
                            ? 'Hapus produk ini dari daftar unggulan?'
                            : 'Jadikan produk ini sebagai produk unggulan?'),

                    Tables\Actions\Action::make('toggle_status')
                        ->label(fn (Produk $record) => $record->status_tersedia ? 'Tandai Tidak Tersedia' : 'Tandai Tersedia')
                        ->icon('heroicon-o-arrow-path')
                        ->color(fn (Produk $record) => $record->status_tersedia ? 'warning' : 'success')
                        ->action(function (Produk $record) {
                            $record->update(['status_tersedia' => !$record->status_tersedia]);

                            Notification::make()
                                ->success()
                                ->title('Status diperbarui')
                                ->body($record->status_tersedia ? 'Produk sekarang tersedia' : 'Produk tidak tersedia')
                                ->send();
                        }),

                    Tables\Actions\DeleteAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Produk berhasil dihapus')
                                ->body('Produk telah dihapus dari katalog.')
                        ),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->button()
                ->label('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_available')
                        ->label('Tandai Tersedia')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['status_tersedia' => true]);

                            Notification::make()
                                ->success()
                                ->title('Berhasil diperbarui')
                                ->body(count($records) . ' produk ditandai tersedia')
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('mark_unavailable')
                        ->label('Tandai Tidak Tersedia')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each->update(['status_tersedia' => false]);

                            Notification::make()
                                ->success()
                                ->title('Berhasil diperbarui')
                                ->body(count($records) . ' produk ditandai tidak tersedia')
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('mark_featured')
                        ->label('Jadikan Unggulan')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each->update(['is_featured' => true]);

                            Notification::make()
                                ->success()
                                ->title('Berhasil diperbarui')
                                ->body(count($records) . ' produk ditandai sebagai unggulan')
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Produk berhasil dihapus')
                                ->body('Produk terpilih telah dihapus dari katalog.')
                        ),
                ]),
            ])
            ->emptyStateHeading('Belum ada produk')
            ->emptyStateDescription('Mulai tambahkan produk untuk UMKM ini.')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Produk Pertama')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped();
    }
}
