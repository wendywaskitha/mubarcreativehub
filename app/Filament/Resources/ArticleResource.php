<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStatsOverview;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Artikel';

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel & Berita';

    protected static ?string $navigationGroup = 'Konten & Media';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Artikel')
                            ->description('Judul, kategori, dan metadata artikel')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Tips Memulai UMKM dari Rumah')
                                    ->prefixIcon('heroicon-o-pencil')
                                    ->autocomplete(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                        if (!$get('slug')) {
                                            $set('slug', Str::slug($state));
                                        }
                                        $set('judul', ucfirst($state));
                                    })
                                    ->columnSpanFull()
                                    ->helperText('Judul yang menarik dan deskriptif (maksimal 255 karakter)'),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('tips-memulai-umkm-dari-rumah')
                                    ->prefixIcon('heroicon-o-link')
                                    ->prefix(url('/artikel/'))
                                    ->helperText('URL ramah SEO (otomatis dari judul)')
                                    ->unique(ignoreRecord: true)
                                    ->alphaDash()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('kategori')
                                    ->label('Kategori Artikel')
                                    ->options([
                                        'Tips & Tutorial' => 'Tips & Tutorial',
                                        'Cerita Sukses UMKM' => 'Cerita Sukses UMKM',
                                        'Event & Kegiatan' => 'Event & Kegiatan',
                                        'Berita Terkini' => 'Berita Terkini',
                                        'Promosi & Penawaran' => 'Promosi & Penawaran',
                                        'Inspirasi Bisnis' => 'Inspirasi Bisnis',
                                        'Panduan Usaha' => 'Panduan Usaha',
                                        'Produk Lokal' => 'Produk Lokal',
                                        'Ekonomi Kreatif' => 'Ekonomi Kreatif',
                                        'Lainnya' => 'Lainnya',
                                    ])
                                    ->placeholder('Pilih Kategori')
                                    ->native(false)
                                    ->searchable()
                                    ->prefixIcon('heroicon-o-folder')
                                    ->helperText('Kategori untuk mengelompokkan artikel'),

                                Forms\Components\TagsInput::make('tags')
                                    ->label('Tags/Kata Kunci')
                                    ->placeholder('Tekan Enter untuk menambah tag')
                                    ->helperText('Tag untuk SEO dan filter (contoh: umkm, bisnis, kuliner)')
                                    ->suggestions([
                                        'UMKM',
                                        'Bisnis',
                                        'Kuliner',
                                        'Fashion',
                                        'Kerajinan',
                                        'Digital Marketing',
                                        'E-commerce',
                                        'Startup',
                                        'Wirausaha',
                                        'Ekonomi Kreatif',
                                    ])
                                    ->separator(',')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan/Excerpt')
                                    ->maxLength(500)
                                    ->rows(3)
                                    ->placeholder('Tulis ringkasan singkat artikel (akan muncul di preview)...')
                                    ->columnSpanFull()
                                    ->helperText('Ringkasan artikel untuk preview dan SEO (maksimal 500 karakter)'),
                            ])->columns(2),

                        Forms\Components\Section::make('Konten Artikel')
                            ->description('Tulis konten artikel lengkap dengan format yang menarik')
                            ->icon('heroicon-o-document')
                            ->schema([
                                Forms\Components\RichEditor::make('konten')
                                    ->label('Isi Artikel')
                                    ->required()
                                    ->placeholder('Tulis konten artikel Anda di sini...')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'link',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'h4',
                                        'blockquote',
                                        'codeBlock',
                                        'redo',
                                        'undo',
                                    ])
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('article-attachments')
                                    ->helperText('Format teks dengan heading, bold, list untuk konten yang mudah dibaca'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status Publikasi')
                            ->description('Atur status dan waktu publikasi')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Status Artikel')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'scheduled' => 'Scheduled',
                                        'archived' => 'Archived',
                                    ])
                                    ->required()
                                    ->default('draft')
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-document')
                                    ->live()
                                    ->helperText('Status publikasi artikel')
                                    ->columnSpanFull(),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal & Waktu Publikasi')
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-calendar')
                                    ->helperText('Kosongkan untuk publish sekarang')
                                    ->default(now())
                                    ->seconds(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->columnSpanFull()
                                    ->visible(fn (Forms\Get $get) =>
                                        in_array($get('status'), ['published', 'scheduled'])
                                    ),

                                Forms\Components\Placeholder::make('status_info')
                                    ->label('Informasi Status')
                                    ->content(function (Forms\Get $get) {
                                        $status = $get('status') ?? 'draft';
                                        $published_at = $get('published_at');

                                        $badges = [
                                            'draft' => '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">📝 Draft</span>',
                                            'published' => '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">✅ Published</span>',
                                            'scheduled' => '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">⏰ Scheduled</span>',
                                            'archived' => '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">📦 Archived</span>',
                                        ];

                                        $html = '<div class="space-y-2">';
                                        $html .= '<div>' . ($badges[$status] ?? '') . '</div>';

                                        if ($status === 'scheduled' && $published_at) {
                                            $html .= '<div class="text-sm text-gray-600">Akan dipublikasikan: ' . \Carbon\Carbon::parse($published_at)->format('d M Y, H:i') . '</div>';
                                        }

                                        $html .= '</div>';

                                        return new \Illuminate\Support\HtmlString($html);
                                    })
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Featured Image')
                            ->description('Gambar utama artikel')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('article-images')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->helperText('Gambar utama artikel (Max: 2MB)')
                                    ->columnSpanFull()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675'),

                                Forms\Components\Placeholder::make('image_info')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString(
                                        '<div class="text-xs text-gray-500 space-y-1 bg-blue-50 p-3 rounded-lg">
                                            <p class="font-semibold text-blue-800">📐 Rekomendasi:</p>
                                            <ul class="list-disc list-inside space-y-1 ml-2">
                                                <li><strong>Ukuran:</strong> 1200 x 675 pixels (16:9)</li>
                                                <li><strong>Format:</strong> JPG, PNG, WebP</li>
                                                <li><strong>Ukuran File:</strong> Max 2MB</li>
                                            </ul>
                                        </div>'
                                    ))
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('SEO & Metadata')
                            ->description('Pengaturan SEO dan metadata')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->placeholder('Judul untuk mesin pencari')
                                    ->prefixIcon('heroicon-o-tag')
                                    ->helperText('Optimal: 50-60 karakter')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->placeholder('Deskripsi untuk mesin pencari')
                                    ->helperText('Optimal: 150-160 karakter')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('views')
                                    ->label('Jumlah Views')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefixIcon('heroicon-o-eye')
                                    ->helperText('Otomatis dihitung sistem')
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->collapsed(),

                        Forms\Components\Section::make('Penulis')
                            ->description('Informasi penulis artikel')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Penulis')
                                    ->relationship('user', 'name')
                                    ->default(Auth::id())
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-user-circle')
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->collapsed(),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn (Article $record): string => $record->judul),

                Tables\Columns\TextColumn::make('excerpt')
                    ->label('Ringkasan')
                    ->limit(60)
                    ->default('-'),

                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->defaultImageUrl(url('/images/default-article.png'))
                    ->size(60)
                    ->square(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tags')
                    ->label('Tags')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                        'archived' => 'Archived',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publish')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state)),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                        'archived' => 'Archived',
                    ])
                    ->label('Status')
                    ->placeholder('Semua Status')
                    ->multiple()
                    ->indicator('Status'),

                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Tips & Tutorial' => 'Tips & Tutorial',
                        'Cerita Sukses UMKM' => 'Cerita Sukses UMKM',
                        'Event & Kegiatan' => 'Event & Kegiatan',
                        'Berita Terkini' => 'Berita Terkini',
                        'Promosi & Penawaran' => 'Promosi & Penawaran',
                        'Inspirasi Bisnis' => 'Inspirasi Bisnis',
                        'Panduan Usaha' => 'Panduan Usaha',
                        'Produk Lokal' => 'Produk Lokal',
                        'Ekonomi Kreatif' => 'Ekonomi Kreatif',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->label('Kategori')
                    ->multiple()
                    ->searchable(),

                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Penulis')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                Tables\Filters\Filter::make('has_featured_image')
                    ->label('Memiliki Gambar')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('featured_image')
                              ->where('featured_image', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('popular')
                    ->label('Artikel Populer (>100 views)')
                    ->query(fn (Builder $query): Builder =>
                        $query->where('views', '>', 100)
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = 'Dari: ' . \Carbon\Carbon::parse($data['from'])->format('d M Y');
                        }
                        if ($data['until'] ?? null) {
                            $indicators[] = 'Sampai: ' . \Carbon\Carbon::parse($data['until'])->format('d M Y');
                        }
                        return $indicators;
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

                    Tables\Actions\Action::make('publish')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Article $record) {
                            $record->update([
                                'status' => 'published',
                                'published_at' => now(),
                            ]);
                        })
                        ->visible(fn (Article $record) => $record->status === 'draft')
                        ->successNotificationTitle('Artikel berhasil dipublikasikan'),

                    Tables\Actions\Action::make('unpublish')
                        ->label('Unpublish')
                        ->icon('heroicon-o-arrow-down-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (Article $record) {
                            $record->update(['status' => 'draft']);
                        })
                        ->visible(fn (Article $record) => $record->status === 'published')
                        ->successNotificationTitle('Artikel dikembalikan ke draft'),

                    Tables\Actions\Action::make('archive')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->action(function (Article $record) {
                            $record->update(['status' => 'archived']);
                        })
                        ->visible(fn (Article $record) => $record->status !== 'archived'),

                    Tables\Actions\Action::make('duplicate')
                        ->label('Duplikat')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->action(function (Article $record) {
                            $newArticle = $record->replicate();
                            $newArticle->judul = $record->judul . ' (Copy)';
                            $newArticle->slug = Str::slug($newArticle->judul) . '-' . time();
                            $newArticle->status = 'draft';
                            $newArticle->published_at = null;
                            $newArticle->views = 0;
                            $newArticle->save();
                        })
                        ->successNotificationTitle('Artikel berhasil diduplikat'),

                    Tables\Actions\Action::make('preview')
                        ->label('Preview')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->url(fn (Article $record): string =>
                            url('/artikel/' . $record->slug)
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
                        ->modalHeading('Hapus Artikel')
                        ->modalDescription('Apakah Anda yakin ingin menghapus artikel terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'status' => 'published',
                                    'published_at' => now(),
                                ]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('draft')
                        ->label('Set Draft')
                        ->icon('heroicon-o-pencil')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status' => 'draft']);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('archive')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status' => 'archived']);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('change_category')
                        ->label('Ubah Kategori')
                        ->icon('heroicon-o-folder')
                        ->color('info')
                        ->form([
                            Forms\Components\Select::make('kategori')
                                ->label('Kategori Baru')
                                ->options([
                                    'Tips & Tutorial' => 'Tips & Tutorial',
                                    'Cerita Sukses UMKM' => 'Cerita Sukses UMKM',
                                    'Event & Kegiatan' => 'Event & Kegiatan',
                                    'Berita Terkini' => 'Berita Terkini',
                                    'Promosi & Penawaran' => 'Promosi & Penawaran',
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
            ->emptyStateHeading('Belum Ada Artikel')
            ->emptyStateDescription('Mulai tulis artikel pertama Anda untuk berbagi informasi')
            ->emptyStateIcon('heroicon-o-newspaper')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tulis Artikel')
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
                Components\Section::make('Preview Artikel')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Components\ImageEntry::make('featured_image')
                            ->label('')
                            ->defaultImageUrl(url('/images/default-article.png'))
                            ->size(600)
                            ->columnSpanFull(),

                        Components\TextEntry::make('judul')
                            ->label('')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->color('primary')
                            ->columnSpanFull(),

                        Components\Grid::make(4)
                            ->schema([
                                Components\TextEntry::make('kategori')
                                    ->badge()
                                    ->color('info')
                                    ->icon('heroicon-o-folder'),

                                Components\TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (Article $record): string => match ($record->status) {
                                        'published' => 'success',
                                        'draft' => 'warning',
                                        'scheduled' => 'info',
                                        'archived' => 'gray',
                                        default => 'gray',
                                    }),

                                Components\TextEntry::make('views')
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-o-eye')
                                    ->suffix(' views'),

                                Components\TextEntry::make('published_at')
                                    ->label('Tanggal')
                                    ->date('d M Y')
                                    ->icon('heroicon-o-calendar'),
                            ]),
                    ]),

                Components\Section::make('Konten Artikel')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Components\TextEntry::make('excerpt')
                            ->label('Ringkasan')
                            ->markdown()
                            ->default('Tidak ada ringkasan')
                            ->columnSpanFull(),

                        Components\TextEntry::make('konten')
                            ->label('Isi Artikel')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Components\Section::make('Metadata & SEO')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('slug')
                                    ->label('Slug')
                                    ->copyable()
                                    ->prefix(url('/artikel/')),

                                Components\TextEntry::make('user.name')
                                    ->label('Penulis')
                                    ->badge()
                                    ->color('purple')
                                    ->icon('heroicon-o-user'),

                                Components\TextEntry::make('meta_title')
                                    ->label('Meta Title')
                                    ->default('-'),

                                Components\TextEntry::make('meta_description')
                                    ->label('Meta Description')
                                    ->default('-')
                                    ->columnSpan(2),

                                Components\TextEntry::make('tags')
                                    ->label('Tags')
                                    ->badge()
                                    ->separator(',')
                                    ->color('gray')
                                    ->columnSpan(2)
                                    ->default('-'),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Informasi Sistem')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-calendar')
                                    ->description(fn (Article $record): string =>
                                        $record->created_at->diffForHumans()
                                    ),

                                Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d F Y, H:i:s')
                                    ->icon('heroicon-o-arrow-path')
                                    ->description(fn (Article $record): string =>
                                        $record->updated_at->diffForHumans()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'published')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('status', 'published')->count();
        if ($count > 50) return 'success';
        if ($count > 20) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->judul;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Kategori' => $record->kategori ?? '-',
            'Status' => ucfirst($record->status),
            'Penulis' => $record->user->name ?? '-',
            'Views' => number_format($record->views) . ' views',
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['judul', 'excerpt', 'konten', 'kategori', 'tags', 'user.name'];
    }
}
