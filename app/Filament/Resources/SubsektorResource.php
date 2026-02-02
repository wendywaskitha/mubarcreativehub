<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubsektorResource\Pages;
use App\Filament\Resources\SubsektorResource\RelationManagers;
use App\Models\Subsektor;
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

class SubsektorResource extends Resource
{
    protected static ?string $model = Subsektor::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Subsektor';

    protected static ?string $modelLabel = 'Subsektor';

    protected static ?string $pluralModelLabel = 'Subsektor Ekonomi Kreatif';

    protected static ?string $navigationGroup = 'Ekonomi Kreatif';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama_subsektor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Subsektor')
                    ->description('Definisikan subsektor ekonomi kreatif dengan identitas visual yang menarik')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Forms\Components\TextInput::make('nama_subsektor')
                            ->label('Nama Subsektor')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Kerajinan Tangan, Kuliner, Fashion')
                            ->prefixIcon('heroicon-o-tag')
                            ->columnSpanFull()
                            ->autocomplete(false)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('nama_subsektor', ucwords(strtolower($state)));
                            })
                            ->helperText('Nama akan otomatis diformat dengan huruf kapital di awal kata')
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Identitas Visual')
                    ->description('Berikan identitas visual unik untuk memudahkan pengenalan subsektor')
                    ->icon('heroicon-o-swatch')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Ikon Emoji')
                                    ->maxLength(10)
                                    ->placeholder('🎨')
                                    ->helperText('Pilih emoji yang merepresentasikan subsektor')
                                    ->prefixIcon('heroicon-o-face-smile')
                                    ->live()
                                    ->suffixAction(
                                        Forms\Components\Actions\Action::make('emoji_picker')
                                            ->icon('heroicon-o-face-smile')
                                            ->tooltip('Panduan Emoji')
                                            ->modalHeading('Panduan Pemilihan Emoji')
                                            ->modalDescription('Pilih emoji yang sesuai dengan subsektor Anda')
                                            ->modalContent(view('filament.forms.components.emoji-guide'))
                                            ->modalSubmitAction(false)
                                            ->modalCancelActionLabel('Tutup')
                                    ),

                                Forms\Components\ColorPicker::make('color_code')
                                    ->label('Kode Warna Brand')
                                    ->helperText('Warna identitas untuk subsektor ini')
                                    ->rgba()
                                    ->live()
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        // Auto-suggest complementary colors
                                    }),
                            ]),

                        Forms\Components\Placeholder::make('preview')
                            ->label('Preview Identitas')
                            ->content(function ($get) {
                                $icon = $get('icon') ?? '📦';
                                $name = $get('nama_subsektor') ?? 'Subsektor';
                                $color = $get('color_code') ?? '#6366f1';

                                return new \Illuminate\Support\HtmlString(
                                    '<div style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 20px; background: ' . $color . '20; border: 2px solid ' . $color . '; border-radius: 12px; margin-top: 8px;">
                                        <span style="font-size: 32px;">' . $icon . '</span>
                                        <div>
                                            <div style="font-weight: 600; font-size: 16px; color: ' . $color . ';">' . $name . '</div>
                                            <div style="font-size: 12px; color: #6b7280;">Ekonomi Kreatif</div>
                                        </div>
                                    </div>'
                                );
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Emoji Populer untuk Ekonomi Kreatif')
                    ->description('Referensi cepat emoji yang sering digunakan')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Forms\Components\Placeholder::make('emoji_suggestions')
                            ->label('')
                            ->content(new \Illuminate\Support\HtmlString('
                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px; margin-top: 8px;">
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🧵</span>
                                        <span style="font-size: 12px;">Fashion & Tekstil</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🍴</span>
                                        <span style="font-size: 12px;">Kuliner</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🪑</span>
                                        <span style="font-size: 12px;">Furniture</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🎨</span>
                                        <span style="font-size: 12px;">Seni Rupa</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🎭</span>
                                        <span style="font-size: 12px;">Seni Pertunjukan</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">📸</span>
                                        <span style="font-size: 12px;">Fotografi</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🎬</span>
                                        <span style="font-size: 12px;">Film & Video</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🎮</span>
                                        <span style="font-size: 12px;">Game</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">💻</span>
                                        <span style="font-size: 12px;">Teknologi</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">📚</span>
                                        <span style="font-size: 12px;">Penerbitan</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">🎵</span>
                                        <span style="font-size: 12px;">Musik</span>
                                    </div>
                                    <div style="padding: 8px; background: #f3f4f6; border-radius: 8px;">
                                        <span style="font-size: 24px; margin-right: 8px;">✨</span>
                                        <span style="font-size: 12px;">Kerajinan</span>
                                    </div>
                                </div>
                            ')),
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
                    ->alignCenter()
                    ->label('#'),

                Tables\Columns\TextColumn::make('icon')
                    ->label('Ikon')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::Large)
                    ->alignCenter()
                    ->extraAttributes(['style' => 'font-size: 32px;'])
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_subsektor')
                    ->label('Nama Subsektor')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->copyable()
                    ->copyMessage('Nama subsektor disalin!')
                    ->copyMessageDuration(1500),

                Tables\Columns\ColorColumn::make('color_code')
                    ->label('Warna')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('pelaku_count')
                    ->label('Total Pelaku')
                    ->counts('pelaku')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-users')
                    ->alignCenter()
                    ->sortable()
                    ->default(0)
                    ->formatStateUsing(fn ($state) => number_format($state) . ' Pelaku'),

                Tables\Columns\IconColumn::make('has_visual_identity')
                    ->label('Identitas Lengkap')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->getStateUsing(fn (Subsektor $record): bool =>
                        !empty($record->icon) && !empty($record->color_code)
                    )
                    ->tooltip(fn (Subsektor $record): string =>
                        (!empty($record->icon) && !empty($record->color_code))
                            ? 'Identitas visual lengkap'
                            : 'Identitas visual belum lengkap'
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (Subsektor $record): string =>
                        $record->created_at->diffForHumans()
                    ),
            ])
            ->defaultSort('nama_subsektor', 'asc')
            ->filters([
                Tables\Filters\Filter::make('has_icon')
                    ->label('Dengan Ikon')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('icon')
                              ->where('icon', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('has_color')
                    ->label('Dengan Warna')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('color_code')
                              ->where('color_code', '!=', '')
                    )
                    ->toggle(),

                Tables\Filters\Filter::make('complete_identity')
                    ->label('Identitas Lengkap')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('icon')
                              ->where('icon', '!=', '')
                              ->whereNotNull('color_code')
                              ->where('color_code', '!=', '')
                    )
                    ->toggle()
                    ->default(false),

                Tables\Filters\Filter::make('has_pelaku')
                    ->label('Memiliki Pelaku')
                    ->query(fn (Builder $query): Builder =>
                        $query->has('pelaku')
                    )
                    ->toggle(),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->persistFiltersInSession()
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),

                    Tables\Actions\EditAction::make()
                        ->color('warning'),

                    Tables\Actions\Action::make('duplicate')
                        ->label('Duplikat')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->form([
                            Forms\Components\TextInput::make('nama_subsektor')
                                ->label('Nama Subsektor Baru')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->action(function (Subsektor $record, array $data) {
                            Subsektor::create([
                                'nama_subsektor' => $data['nama_subsektor'],
                                'icon' => $record->icon,
                                'color_code' => $record->color_code,
                            ]);
                        })
                        ->successNotificationTitle('Subsektor berhasil diduplikat'),

                    Tables\Actions\Action::make('preview')
                        ->label('Preview Badge')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->modalContent(fn (Subsektor $record) => view('filament.modals.subsektor-preview', [
                            'record' => $record,
                        ]))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Tutup'),

                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Subsektor')
                        ->modalDescription('Apakah Anda yakin ingin menghapus subsektor terpilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('set_color')
                        ->label('Atur Warna')
                        ->icon('heroicon-o-swatch')
                        ->color('primary')
                        ->form([
                            Forms\Components\ColorPicker::make('color_code')
                                ->label('Warna Baru')
                                ->required()
                                ->rgba(),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->update(['color_code' => $data['color_code']]);
                            }
                        })
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
            ->emptyStateHeading('Belum Ada Subsektor')
            ->emptyStateDescription('Mulai tambahkan subsektor ekonomi kreatif untuk sistem Anda')
            ->emptyStateIcon('heroicon-o-sparkles')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Subsektor')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s')
            ->persistSearchInSession()
            ->persistSortInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Preview Subsektor')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Components\View::make('filament.infolists.subsektor-card')
                            ->columnSpanFull(),
                    ]),

                Components\Section::make('Informasi Subsektor')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Components\TextEntry::make('nama_subsektor')
                            ->label('Nama Subsektor')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-tag')
                            ->copyable()
                            ->color('primary'),
                    ]),

                Components\Section::make('Identitas Visual')
                    ->icon('heroicon-o-swatch')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('icon')
                                    ->label('Ikon Emoji')
                                    ->size(Components\TextEntry\TextEntrySize::Large)
                                    ->default('-')
                                    ->extraAttributes(['style' => 'font-size: 48px;']),

                                Components\ColorEntry::make('color_code')
                                    ->label('Kode Warna Brand')
                                    ->copyable()
                                    ->copyMessage('Kode warna disalin!')
                                    ->default('#6366f1'),

                                Components\TextEntry::make('color_code')
                                    ->label('Hex Code')
                                    ->badge()
                                    ->copyable()
                                    ->default('#6366f1'),
                            ]),
                    ]),

                Components\Section::make('Statistik')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('pelaku_count')
                                    ->label('Total Pelaku')
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-o-users')
                                    ->default(0)
                                    ->formatStateUsing(fn ($state) => number_format($state) . ' Pelaku'),

                                Components\IconEntry::make('has_icon')
                                    ->label('Status Ikon')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger')
                                    ->getStateUsing(fn (Subsektor $record): bool => !empty($record->icon)),

                                Components\IconEntry::make('has_color')
                                    ->label('Status Warna')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger')
                                    ->getStateUsing(fn (Subsektor $record): bool => !empty($record->color_code)),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubsektors::route('/'),
            'create' => Pages\CreateSubsektor::route('/create'),
            'view' => Pages\ViewSubsektor::route('/{record}'),
            'edit' => Pages\EditSubsektor::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::count();
        if ($count >= 10) return 'success';
        if ($count >= 5) return 'warning';
        return 'danger';
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return ($record->icon ?? '📦') . ' ' . $record->nama_subsektor;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Kategori' => 'Ekonomi Kreatif',
            'Warna' => $record->color_code ?? '-',
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_subsektor', 'icon'];
    }
}
