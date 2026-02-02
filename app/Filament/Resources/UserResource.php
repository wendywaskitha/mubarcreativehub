<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna';

    protected static ?string $navigationGroup = 'Manajemen Sistem';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return true; // Izinkan semua pengguna terautentikasi untuk melihat resource
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengguna')
                    ->description('Informasi dasar tentang pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama lengkap')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('pengguna@contoh.com')
                            ->columnSpanFull(),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Tanggal Email Diverifikasi')
                            ->placeholder('Pilih tanggal verifikasi')
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Kata Sandi')
                    ->description('Atur kata sandi yang aman untuk pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8)
                            ->maxLength(255)
                            ->confirmed()
                            ->placeholder('Masukkan kata sandi'),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->revealable()
                            ->label('Konfirmasi Kata Sandi')
                            ->placeholder('Konfirmasi kata sandi'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->email)
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email disalin ke papan klip!')
                    ->copyMessageDuration(1500),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Terverifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('warning'), // Menggunakan warning untuk null/opsional

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label('Email Diverifikasi')
                    ->query(fn ($query) => $query->whereNotNull('email_verified_at')),

                Tables\Filters\Filter::make('unverified')
                    ->label('Email Belum Diverifikasi')
                    ->query(fn ($query) => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Buat Pengguna'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
