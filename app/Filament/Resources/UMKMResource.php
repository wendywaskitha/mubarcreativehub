<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UMKMResource\Pages;
use App\Filament\Resources\UMKMResource\RelationManagers;
use App\Models\UMKM;
use App\Imports\UMKMImport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UMKMResource extends Resource
{
    protected static ?string $model = UMKM::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Pelaku Ekraf';

    protected static ?string $modelLabel = 'Pelaku Ekraf';

    protected static ?string $pluralModelLabel = 'Data Pelaku Ekraf';

    protected static ?string $navigationGroup = 'Ekonomi Kreatif';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'nama_usaha';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Informasi Umum')
                        ->icon('heroicon-o-information-circle')
                        ->description('Data dasar usaha dan pemilik')
                        ->schema([
                            Forms\Components\Section::make()
                                ->schema([
                                    // Forms\Components\FileUpload::make('logo')
                                    //     ->label('Logo/Foto Usaha')
                                    //     ->image()
                                    //     ->maxSize(2048)
                                    //     ->directory('umkm-logos')
                                    //     ->imageEditor()
                                    //     ->imageEditorAspectRatios([
                                    //         '1:1',
                                    //         '16:9',
                                    //     ])
                                    //     ->circleCropper()
                                    //     ->avatar()
                                    //     ->helperText('Upload logo atau foto usaha (Maks. 2MB)')
                                    //     ->columnSpanFull(),

                                    Forms\Components\TextInput::make('nama_usaha')
                                        ->label('Nama Usaha')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Contoh: Batik Nusantara')
                                        ->prefixIcon('heroicon-o-building-storefront')
                                        ->autocomplete(false)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            $set('nama_usaha', ucwords(strtolower($state)));
                                        })
                                        ->unique(ignoreRecord: true)
                                        ->columnSpanFull(),

                                    Forms\Components\TextInput::make('nama_pemilik')
                                        ->label('Nama Pemilik/Pengelola')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Contoh: Budi Santoso')
                                        ->prefixIcon('heroicon-o-user')
                                        ->autocomplete(false)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            $set('nama_pemilik', ucwords(strtolower($state)));
                                        }),

                                    Forms\Components\Select::make('subsektor_id')
                                        ->label('Subsektor Ekonomi Kreatif')
                                        ->relationship('subsektor', 'nama_subsektor')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-sparkles')
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('nama_subsektor')
                                                ->required(),
                                            Forms\Components\TextInput::make('icon')
                                                ->maxLength(10),
                                            Forms\Components\ColorPicker::make('color_code'),
                                        ])
                                        ->createOptionModalHeading('Tambah Subsektor Baru')
                                        ->live()
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            if ($state) {
                                                $subsektor = \App\Models\Subsektor::find($state);
                                                // You can set additional fields based on subsektor
                                            }
                                        }),

                                    Forms\Components\Select::make('jenis_badan_usaha')
                                        ->label('Jenis Badan Usaha')
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
                                        ->placeholder('Pilih Jenis Badan Usaha')
                                        ->native(false)
                                        ->searchable()
                                        ->prefixIcon('heroicon-o-building-office'),

                                    Forms\Components\Select::make('tahun_berdiri')
                                        ->label('Tahun Berdiri')
                                        ->required()
                                        ->options(function () {
                                            $years = [];
                                            $currentYear = date('Y');
                                            for ($i = $currentYear; $i >= 1900; $i--) {
                                                $years[$i] = $i;
                                            }
                                            return $years;
                                        })
                                        ->searchable()
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->helperText('Tahun pertama kali usaha didirikan')
                                        ->rules([
                                            'required',
                                            'integer',
                                            'min:1900',
                                            'max:' . date('Y')
                                        ])
                                        ->validationMessages([
                                            'required' => 'Tahun berdiri wajib diisi.',
                                            'integer' => 'Tahun berdiri harus berupa angka tahun yang valid.',
                                            'min' => 'Tahun berdiri tidak boleh kurang dari 1900.',
                                            'max' => 'Tahun berdiri tidak boleh lebih dari tahun sekarang.'
                                        ]),

                                    Forms\Components\Textarea::make('deskripsi')
                                        ->label('Deskripsi Usaha')
                                        ->placeholder('Ceritakan tentang usaha Anda, produk/jasa yang ditawarkan, dan keunggulan...')
                                        ->rows(4)
                                        ->maxLength(1000)
                                        ->columnSpanFull()
                                        ->helperText('Maksimal 1000 karakter'),
                                ])->columns(2),
                        ]),

                    Forms\Components\Wizard\Step::make('Alamat & Lokasi')
                        ->icon('heroicon-o-map-pin')
                        ->description('Informasi lokasi usaha')
                        ->schema([
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\Select::make('kecamatan_id')
                                        ->label('Kecamatan')
                                        ->relationship('kecamatan', 'nama_kecamatan')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->live()
                                        ->prefixIcon('heroicon-o-map-pin')
                                        ->afterStateUpdated(function (Forms\Set $set) {
                                            $set('desa_id', null);
                                        })
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('nama_kecamatan')
                                                ->required(),
                                        ]),

                                    Forms\Components\Select::make('desa_id')
                                        ->label('Desa/Kelurahan')
                                        ->relationship(
                                            'desa',
                                            'nama_desa',
                                            fn (Builder $query, Forms\Get $get) =>
                                                $query->where('kecamatan_id', $get('kecamatan_id'))
                                        )
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-home-modern')
                                        ->disabled(fn (Forms\Get $get) => !$get('kecamatan_id'))
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('nama_desa')
                                                ->required(),
                                            Forms\Components\Select::make('kecamatan_id')
                                                ->relationship('kecamatan', 'nama_kecamatan')
                                                ->required(),
                                        ]),

                                    Forms\Components\Textarea::make('alamat_usaha')
                                        ->label('Alamat Lengkap')
                                        ->required()
                                        ->placeholder('Jl. Contoh No. 123, RT/RW 001/002')
                                        ->rows(3)
                                        ->columnSpanFull(),

                                ])->columns(2),
                        ]),

                    Forms\Components\Wizard\Step::make('Kontak & Media Sosial')
                        ->icon('heroicon-o-phone')
                        ->description('Informasi kontak dan digital presence')
                        ->schema([
                            Forms\Components\Section::make('Kontak Utama')
                                ->icon('heroicon-o-phone')
                                ->schema([
                                    Forms\Components\TextInput::make('no_telp')
                                        ->label('Nomor Telepon/HP')
                                        ->tel()
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('6281234567890')
                                        ->prefixIcon('heroicon-o-phone')
                                        ->prefix('+')
                                        ->helperText('Format internasional tanpa tanda + (contoh: 6281234567890)')
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            // Auto-generate WhatsApp link
                                            if ($state && !str_starts_with($state, '62')) {
                                                $state = '62' . ltrim($state, '0');
                                            }
                                            $set('no_telp', $state);
                                        }),

                                    Forms\Components\TextInput::make('email')
                                        ->label('Alamat Email')
                                        ->email()
                                        ->maxLength(255)
                                        ->placeholder('usaha@example.com')
                                        ->prefixIcon('heroicon-o-envelope')
                                        ->helperText('Email untuk komunikasi bisnis'),
                                ])->columns(2),

                            Forms\Components\Section::make('Media Sosial')
                                ->icon('heroicon-o-share')
                                ->description('Link akun media sosial usaha Anda')
                                ->schema([
                                    Forms\Components\TextInput::make('whatsapp')
                                        ->label('WhatsApp Business')
                                        ->maxLength(255)
                                        ->placeholder('https://wa.me/6281234567890')
                                        ->prefixIcon('heroicon-o-chat-bubble-left-right')
                                        ->prefix('wa.me/')
                                        ->helperText('Link WhatsApp untuk pelanggan'),

                                    Forms\Components\TextInput::make('instagram')
                                        ->label('Instagram')
                                        ->maxLength(255)
                                        ->placeholder('@username atau URL lengkap')
                                        ->prefix('@')
                                        ->prefixIcon('heroicon-o-camera')
                                        ->helperText('Username Instagram tanpa @'),

                                    Forms\Components\TextInput::make('facebook')
                                        ->label('Facebook')
                                        ->maxLength(255)
                                        ->placeholder('https://facebook.com/username')
                                        ->url()
                                        ->prefixIcon('heroicon-o-user-group')
                                        ->helperText('Link halaman Facebook'),

                                    Forms\Components\TextInput::make('tiktok')
                                        ->label('TikTok')
                                        ->maxLength(255)
                                        ->placeholder('@username atau URL lengkap')
                                        ->prefix('@')
                                        ->prefixIcon('heroicon-o-musical-note')
                                        ->helperText('Username TikTok tanpa @'),

                                    Forms\Components\TextInput::make('website')
                                        ->label('Website/E-commerce')
                                        ->maxLength(255)
                                        ->url()
                                        ->placeholder('https://website.com')
                                        ->prefixIcon('heroicon-o-globe-alt')
                                        ->helperText('Website resmi atau toko online'),
                                ])->columns(2),
                        ]),

                    Forms\Components\Wizard\Step::make('Data Usaha')
                        ->icon('heroicon-o-chart-bar')
                        ->description('Informasi operasional dan finansial')
                        ->schema([
                            Forms\Components\Section::make('Kapasitas Usaha')
                                ->icon('heroicon-o-users')
                                ->schema([
                                    Forms\Components\TextInput::make('jumlah_tenaga_kerja')
                                        ->label('Jumlah Tenaga Kerja')
                                        ->numeric()
                                        ->minValue(0)
                                        ->default(1)
                                        ->placeholder('0')
                                        ->prefixIcon('heroicon-o-users')
                                        ->suffix('Orang')
                                        ->helperText('Total karyawan/pekerja yang aktif'),

                                    Forms\Components\TextInput::make('omset_tahun')
                                        ->label('Omset per Tahun')
                                        ->numeric()
                                        ->minValue(0)
                                        ->placeholder('50000000')
                                        ->prefix('Rp')
                                        ->prefixIcon('heroicon-o-banknotes')
                                        ->helperText('Perkiraan omset tahunan dalam Rupiah')
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                                            // Format to show in K/M/B
                                        }),
                                ])->columns(2),

                            Forms\Components\Section::make('Legalitas & Perizinan')
                                ->icon('heroicon-o-document-check')
                                ->description('Dokumen legal dan perizinan usaha')
                                ->schema([
                                    Forms\Components\TextInput::make('nib')
                                        ->label('NIB (Nomor Induk Berusaha)')
                                        ->maxLength(100)
                                        ->placeholder('1234567890123')
                                        ->prefixIcon('heroicon-o-identification')
                                        ->helperText('Nomor Induk Berusaha dari OSS'),

                                    Forms\Components\TextInput::make('jenis_hki')
                                        ->label('Jenis HKI (Hak Kekayaan Intelektual)')
                                        ->maxLength(100)
                                        ->placeholder('Merek, Paten, Hak Cipta, dll')
                                        ->prefixIcon('heroicon-o-shield-check')
                                        ->helperText('Jika memiliki HKI terdaftar'),
                                ])->columns(2),
                        ]),

                    Forms\Components\Wizard\Step::make('Status & Verifikasi')
                        ->icon('heroicon-o-check-badge')
                        ->description('Status aktivasi dan verifikasi usaha')
                        ->schema([
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\Toggle::make('status_aktif')
                                        ->label('Status Aktif')
                                        ->helperText('Usaha masih beroperasi')
                                        ->default(true)
                                        ->inline(false)
                                        ->columnSpanFull(),

                                    Forms\Components\Toggle::make('status_verifikasi')
                                        ->label('Status Verifikasi')
                                        ->helperText('Data telah diverifikasi oleh admin')
                                        ->default(false)
                                        ->inline(false)
                                        ->columnSpanFull(),

                                    Forms\Components\Placeholder::make('verification_info')
                                        ->label('')
                                        ->content(function (Forms\Get $get) {
                                            $aktif = $get('status_aktif');
                                            $verifikasi = $get('status_verifikasi');

                                            return new \Illuminate\Support\HtmlString(
                                                '<div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-3 h-3 rounded-full ' . ($aktif ? 'bg-green-500' : 'bg-gray-300') . '"></span>
                                                        <span class="text-sm">' . ($aktif ? 'Usaha Aktif' : 'Usaha Tidak Aktif') . '</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-3 h-3 rounded-full ' . ($verifikasi ? 'bg-blue-500' : 'bg-gray-300') . '"></span>
                                                        <span class="text-sm">' . ($verifikasi ? 'Data Terverifikasi' : 'Menunggu Verifikasi') . '</span>
                                                    </div>
                                                </div>'
                                            );
                                        })
                                        ->columnSpanFull(),
                                ])->columns(1),
                        ]),
                ])
                ->columnSpanFull()
                ->persistStepInQueryString()
                ->submitAction(new \Illuminate\Support\HtmlString('<button type="submit" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700">Simpan Data UMKM</button>')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex()
                    ->alignCenter(),

                // Tables\Columns\ImageColumn::make('logo')
                //     ->label('Logo')
                //     ->circular()
                //     ->defaultImageUrl(url('/images/default-store.png'))
                //     ->size(50),

                Tables\Columns\TextColumn::make('nama_usaha')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-o-building-storefront')
                    ->iconColor('primary')
                    ->description(fn (UMKM $record): string =>
                        $record->subsektor->nama_subsektor ?? '-'
                    )
                    ->copyable()
                    ->copyMessage('Nama usaha disalin!')
                    ->wrap(),

                Tables\Columns\TextColumn::make('nama_pemilik')
                    ->label('Pemilik')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('subsektor.nama_subsektor')
                    ->label('Subsektor')
                    ->sortable()
                    ->badge()
                    ->color(fn (UMKM $record) => 'primary')
                    ->formatStateUsing(function (UMKM $record) {
                        $icon = $record->subsektor->icon ?? '📦';
                        return $icon . ' ' . $record->subsektor->nama_subsektor;
                    })
                    ->toggleable(),


                Tables\Columns\TextColumn::make('jenis_badan_usaha')
                    ->label('Badan Usaha')
                    ->badge()
                    ->color('gray')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tahun_berdiri')
                    ->label('Berdiri')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->formatStateUsing(fn (UMKM $record): string => $record->tahun_berdiri)
                    ->description(fn (UMKM $record): string =>
                        now()->year - $record->tahun_berdiri . ' tahun'
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('jumlah_tenaga_kerja')
                    ->label('Tenaga Kerja')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-users')
                    ->badge()
                    ->color('success')
                    ->suffix(' Orang')
                    ->alignCenter()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('omset_tahun')
                    ->label('Omset/Tahun')
                    ->money('IDR', divideBy: 1)
                    ->sortable()
                    ->icon('heroicon-o-banknotes')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('no_telp')
                    ->label('Kontak')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->copyable()
                    ->copyMessage('Nomor disalin!')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('status_aktif')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\IconColumn::make('status_verifikasi')
                    ->label('Verifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-shield-exclamation')
                    ->trueColor('info')
                    ->falseColor('warning')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->description(fn (UMKM $record): string =>
                        $record->created_at->diffForHumans()
                    )
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->label('Kecamatan')
                    ->placeholder('Semua Kecamatan')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Kecamatan'),

                Tables\Filters\SelectFilter::make('desa')
                    ->relationship('desa', 'nama_desa')
                    ->label('Desa/Kelurahan')
                    ->placeholder('Semua Desa')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Desa'),

                Tables\Filters\SelectFilter::make('subsektor')
                    ->relationship('subsektor', 'nama_subsektor')
                    ->label('Subsektor')
                    ->placeholder('Semua Subsektor')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator('Subsektor'),

                Tables\Filters\SelectFilter::make('jenis_badan_usaha')
                    ->options([
                        'Perseorangan' => 'Perseorangan',
                        'CV' => 'CV',
                        'UD' => 'UD',
                        'Kelompok' => 'Kelompok',
                        'Komunitas' => 'Komunitas',
                        'PT' => 'PT',
                        'Koperasi' => 'Koperasi',
                        'Firma' => 'Firma',
                    ])
                    ->label('Jenis Badan Usaha')
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('status_aktif')
                    ->label('Status Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->indicator('Status'),

                Tables\Filters\TernaryFilter::make('status_verifikasi')
                    ->label('Status Verifikasi')
                    ->placeholder('Semua Verifikasi')
                    ->trueLabel('Terverifikasi')
                    ->falseLabel('Belum Verifikasi')
                    ->indicator('Verifikasi'),


                Tables\Filters\Filter::make('has_logo')
                    ->label('Memiliki Logo')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('logo')->where('logo', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('tahun_berdiri')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tahun')
                            ->displayFormat('Y'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tahun')
                            ->displayFormat('Y'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereYear('tahun_berdiri', '>=', date('Y', strtotime($date))),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereYear('tahun_berdiri', '<=', date('Y', strtotime($date))),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = 'Dari: ' . date('Y', strtotime($data['from']));
                        }
                        if ($data['until'] ?? null) {
                            $indicators[] = 'Sampai: ' . date('Y', strtotime($data['until']));
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

                    Tables\Actions\Action::make('verify')
                        ->label('Verifikasi')
                        ->icon('heroicon-o-shield-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (UMKM $record) {
                            $record->update(['status_verifikasi' => true]);
                        })
                        ->visible(fn (UMKM $record) => !$record->status_verifikasi)
                        ->successNotificationTitle('UMKM berhasil diverifikasi'),

                    Tables\Actions\Action::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (UMKM $record) {
                            $record->update(['status_aktif' => true]);
                        })
                        ->visible(fn (UMKM $record) => !$record->status_aktif),

                    Tables\Actions\Action::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (UMKM $record) {
                            $record->update(['status_aktif' => false]);
                        })
                        ->visible(fn (UMKM $record) => $record->status_aktif),


                    Tables\Actions\Action::make('whatsapp')
                        ->label('WhatsApp')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('success')
                        ->url(fn (UMKM $record): string =>
                            'https://wa.me/' . $record->no_telp
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
                        ->modalHeading('Hapus Data UMKM')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data UMKM terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('verify')
                        ->label('Verifikasi')
                        ->icon('heroicon-o-shield-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status_verifikasi' => true]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['status_aktif' => true]);
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
                                $record->update(['status_aktif' => false]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('change_subsektor')
                        ->label('Ubah Subsektor')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('subsektor_id')
                                ->label('Subsektor Baru')
                                ->relationship('subsektor', 'nama_subsektor')
                                ->required()
                                ->searchable()
                                ->preload(),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->update(['subsektor_id' => $data['subsektor_id']]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('export')
                        ->label('Export Data')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('info')
                        ->action(function ($records) {
                            // Add export logic here
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Data UMKM')
            ->emptyStateDescription('Mulai daftarkan UMKM untuk sistem ekonomi kreatif Anda')
            ->emptyStateIcon('heroicon-o-building-storefront')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Daftarkan UMKM')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('60s')
            ->deferLoading()
            ->persistSearchInSession()
            ->persistSortInSession()

            ->persistColumnSearchesInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Profile UMKM')
                    ->icon('heroicon-o-building-storefront')
                    ->schema([
                        Components\Split::make([
                            Components\ImageEntry::make('logo')
                                ->label('')
                                ->circular()
                                ->defaultImageUrl(url('/images/default-store.png'))
                                ->size(120)
                                ->grow(false),

                            Components\Grid::make(2)
                                ->schema([
                                    Components\TextEntry::make('nama_usaha')
                                        ->label('Nama Usaha')
                                        ->size(Components\TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-o-building-storefront')
                                        ->copyable()
                                        ->color('primary')
                                        ->columnSpanFull(),

                                    Components\TextEntry::make('nama_pemilik')
                                        ->label('Pemilik/Pengelola')
                                        ->icon('heroicon-o-user')
                                        ->copyable(),

                                    Components\TextEntry::make('subsektor.nama_subsektor')
                                        ->label('Subsektor')
                                        ->badge()
                                        ->color('success')
                                        ->formatStateUsing(function (UMKM $record) {
                                            $icon = $record->subsektor->icon ?? '📦';
                                            return $icon . ' ' . $record->subsektor->nama_subsektor;
                                        }),

                                    Components\TextEntry::make('jenis_badan_usaha')
                                        ->label('Badan Usaha')
                                        ->badge()
                                        ->color('gray')
                                        ->default('-'),

                                    Components\TextEntry::make('tahun_berdiri')
                                        ->label('Tahun Berdiri')
                                        ->icon('heroicon-o-calendar')
                                        ->date('Y'),
                                ])
                                ->grow(true),
                        ]),

                        Components\TextEntry::make('deskripsi')
                            ->label('Deskripsi Usaha')
                            ->markdown()
                            ->columnSpanFull()
                            ->default('Belum ada deskripsi'),
                    ]),

                Components\Section::make('Lokasi & Alamat')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('kecamatan.nama_kecamatan')
                                    ->label('Kecamatan')
                                    ->icon('heroicon-o-map-pin')
                                    ->badge()
                                    ->color('info'),

                                Components\TextEntry::make('desa.nama_desa')
                                    ->label('Desa/Kelurahan')
                                    ->icon('heroicon-o-home-modern')
                                    ->badge()
                                    ->color('success'),

                            ]),

                        Components\TextEntry::make('alamat_usaha')
                            ->label('Alamat Lengkap')
                            ->icon('heroicon-o-map')
                            ->columnSpanFull()
                            ->copyable(),
                    ]),

                Components\Section::make('Informasi Kontak')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('no_telp')
                                    ->label('Telepon/HP')
                                    ->icon('heroicon-o-phone')
                                    ->copyable()
                                    ->url(fn (UMKM $record) => 'tel:+' . $record->no_telp),

                                Components\TextEntry::make('email')
                                    ->label('Email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable()
                                    ->url(fn (UMKM $record) => 'mailto:' . $record->email)
                                    ->default('-'),

                                Components\TextEntry::make('whatsapp')
                                    ->label('WhatsApp')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->badge()
                                    ->color('success')
                                    ->url(fn (UMKM $record) =>
                                        $record->whatsapp ? 'https://wa.me/' . $record->no_telp : '#'
                                    )
                                    ->openUrlInNewTab()
                                    ->default('-'),
                            ]),
                    ]),

                Components\Section::make('Media Sosial')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Components\Grid::make(4)
                            ->schema([
                                Components\TextEntry::make('instagram')
                                    ->label('Instagram')
                                    ->icon('heroicon-o-camera')
                                    ->badge()
                                    ->color('pink')
                                    ->url(fn (UMKM $record) =>
                                        $record->instagram
                                            ? (str_starts_with($record->instagram, 'http')
                                                ? $record->instagram
                                                : 'https://instagram.com/' . ltrim($record->instagram, '@'))
                                            : '#'
                                    )
                                    ->openUrlInNewTab()
                                    ->default('-'),

                                Components\TextEntry::make('facebook')
                                    ->label('Facebook')
                                    ->icon('heroicon-o-user-group')
                                    ->badge()
                                    ->color('blue')
                                    ->url(fn (UMKM $record) => $record->facebook ?? '#')
                                    ->openUrlInNewTab()
                                    ->default('-'),

                                Components\TextEntry::make('tiktok')
                                    ->label('TikTok')
                                    ->icon('heroicon-o-musical-note')
                                    ->badge()
                                    ->color('gray')
                                    ->url(fn (UMKM $record) =>
                                        $record->tiktok
                                            ? (str_starts_with($record->tiktok, 'http')
                                                ? $record->tiktok
                                                : 'https://tiktok.com/@' . ltrim($record->tiktok, '@'))
                                            : '#'
                                    )
                                    ->openUrlInNewTab()
                                    ->default('-'),

                                Components\TextEntry::make('website')
                                    ->label('Website')
                                    ->icon('heroicon-o-globe-alt')
                                    ->badge()
                                    ->color('primary')
                                    ->url(fn (UMKM $record) => $record->website ?? '#')
                                    ->openUrlInNewTab()
                                    ->default('-'),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Data Operasional')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('jumlah_tenaga_kerja')
                                    ->label('Tenaga Kerja')
                                    ->icon('heroicon-o-users')
                                    ->badge()
                                    ->color('success')
                                    ->suffix(' Orang')
                                    ->default('0'),

                                Components\TextEntry::make('omset_tahun')
                                    ->label('Omset per Tahun')
                                    ->icon('heroicon-o-banknotes')
                                    ->badge()
                                    ->color('warning')
                                    ->money('IDR')
                                    ->default('0'),

                                Components\TextEntry::make('age')
                                    ->label('Usia Usaha')
                                    ->icon('heroicon-o-clock')
                                    ->badge()
                                    ->color('info')
                                    ->getStateUsing(fn (UMKM $record): string =>
                                        now()->year - \Carbon\Carbon::parse($record->tahun_berdiri)->year . ' Tahun'
                                    ),
                            ]),
                    ]),

                Components\Section::make('Legalitas & Perizinan')
                    ->icon('heroicon-o-document-check')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('nib')
                                    ->label('NIB (Nomor Induk Berusaha)')
                                    ->icon('heroicon-o-identification')
                                    ->copyable()
                                    ->default('-'),

                                Components\TextEntry::make('jenis_hki')
                                    ->label('Jenis HKI')
                                    ->icon('heroicon-o-shield-check')
                                    ->badge()
                                    ->color('purple')
                                    ->default('-'),
                            ]),
                    ])
                    ->collapsible(),

                Components\Section::make('Status & Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\IconEntry::make('status_aktif')
                                    ->label('Status Aktif')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),

                                Components\IconEntry::make('status_verifikasi')
                                    ->label('Status Verifikasi')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-shield-check')
                                    ->falseIcon('heroicon-o-shield-exclamation')
                                    ->trueColor('info')
                                    ->falseColor('warning'),
                            ]),
                    ]),

                Components\Section::make('Informasi Sistem')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextEntry::make('created_at')
                                    ->label('Terdaftar')
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
            RelationManagers\ProdukRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUMKMS::route('/'),
            'create' => Pages\CreateUMKM::route('/create'),
            'view' => Pages\ViewUMKM::route('/{record}'),
            'edit' => Pages\EditUMKM::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_aktif', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('status_aktif', true)->count();
        if ($count > 100) return 'success';
        if ($count > 50) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->nama_usaha;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Pemilik' => $record->nama_pemilik,
            'Subsektor' => $record->subsektor->nama_subsektor ?? '-',
            'Lokasi' => $record->desa->nama_desa . ', ' . $record->kecamatan->nama_kecamatan,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_usaha', 'nama_pemilik', 'no_telp', 'email', 'alamat_usaha'];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ekonomi Kreatif';
    }
}
