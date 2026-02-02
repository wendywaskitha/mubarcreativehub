<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Umum';

    protected static ?string $modelLabel = 'Pengaturan';

    protected static ?string $pluralModelLabel = 'Pengaturan Umum';

    protected static ?string $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 99;

    // Override getEloquentQuery to return a single dummy record
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        // Return a query builder for a single dummy model
        return Setting::query()->where('key', '!=', ''); // This will return an empty query that we'll handle specially
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Aplikasi')
                    ->description('Nama aplikasi, deskripsi, logo, dan favicon')
                    ->schema([
                        Forms\Components\TextInput::make('site_title')
                            ->label('Nama Aplikasi')
                            ->placeholder('Contoh: Mubar Creative Hub')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\Textarea::make('site_description')
                            ->label('Deskripsi Aplikasi')
                            ->placeholder('Deskripsi singkat tentang aplikasi ini')
                            ->maxLength(500)
                            ->rows(3)
                            ->required(),

                        Forms\Components\FileUpload::make('site_logo')
                            ->label('Logo Aplikasi')
                            ->placeholder('Upload logo aplikasi')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->directory('settings')
                            ->visibility('public'),

                        Forms\Components\FileUpload::make('frontend_logo')
                            ->label('Logo Frontend')
                            ->placeholder('Upload logo untuk tampilan publik')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->directory('settings')
                            ->visibility('public'),

                        Forms\Components\FileUpload::make('site_favicon')
                            ->label('Favicon')
                            ->placeholder('Upload favicon (ikon situs)')
                            ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon', 'image/svg+xml'])
                            ->maxSize(512)
                            ->directory('settings')
                            ->visibility('public'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Kontak')
                    ->description('Alamat, nomor kontak, dan email')
                    ->schema([
                        Forms\Components\Textarea::make('contact_address')
                            ->label('Alamat')
                            ->placeholder('Alamat lengkap organisasi')
                            ->maxLength(500)
                            ->rows(3)
                            ->required(),

                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Nomor Telepon')
                            ->placeholder('Contoh: 628123456789')
                            ->tel()
                            ->required(),

                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email Kontak')
                            ->placeholder('Contoh: info@mubarcreativehub.com')
                            ->email()
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}