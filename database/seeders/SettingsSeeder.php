<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSettings = [
            [
                'key' => 'site_title',
                'value' => 'Mubar Creative Hub',
            ],
            [
                'key' => 'site_description',
                'value' => 'Platform promosi ekonomi kreatif Kabupaten Muna Barat',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Poros Maligano, Kec. Binongko, Kab. Muna Barat, Sulawesi Tenggara',
            ],
            [
                'key' => 'contact_phone',
                'value' => '628123456789',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@mubarcreativehub.com',
            ],
            [
                'key' => 'site_logo',
                'value' => '',
            ],
            [
                'key' => 'site_favicon',
                'value' => '',
            ],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}