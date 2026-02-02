<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ManageSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSettingsData());
    }

    public function form(Form $form): Form
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
            ->columns(1)
            ->statePath('data');
    }

    protected function getSettingsData(): array
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        // Jika tidak ada pengaturan, gunakan nilai default
        $defaults = [
            'site_title' => 'Mubar Creative Hub',
            'site_description' => 'Platform promosi ekonomi kreatif Kabupaten Muna Barat',
            'contact_address' => 'Jl. Poros Maligano, Kec. Binongko, Kab. Muna Barat, Sulawesi Tenggara',
            'contact_phone' => '628123456789',
            'contact_email' => 'info@mubarcreativehub.com',
            'site_logo' => '',
            'frontend_logo' => '',
            'site_favicon' => '',
        ];

        return array_merge($defaults, $settings);
    }

    public function save(): void
    {
        try {
            DB::transaction(function () {
                $data = $this->form->getState();

                // Get current values to check for file deletions
                $currentValues = Setting::whereIn('key', array_keys($data))->pluck('value', 'key')->toArray();

                foreach ($data as $key => $value) {
                    if ($value !== null) {
                        // If this is a file field and the value has changed, delete the old file
                        if (in_array($key, ['site_logo', 'frontend_logo', 'site_favicon'])) {
                            if (isset($currentValues[$key]) && $currentValues[$key] !== $value && !empty($currentValues[$key])) {
                                // Delete the old file
                                Storage::disk('public')->delete($currentValues[$key]);
                            }
                        }

                        Setting::updateOrCreate(
                            ['key' => $key],
                            ['value' => $value]
                        );
                    } else {
                        // If the value is null, delete the setting entry and remove the file if it exists
                        Setting::deleteKey($key);
                    }
                }
            });

            Notification::make()
                ->title('Pengaturan berhasil disimpan!')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan pengaturan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Simpan Pengaturan')
                ->action('save')
                ->color('primary')
                ->icon('heroicon-o-server'),
        ];
    }
}
