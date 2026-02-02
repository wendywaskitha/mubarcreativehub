<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subsektor;

class SubsektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subsektors = [
            [
                'nama_subsektor' => 'Fashion/Tenun',
                'icon' => '🧵',
                'color_code' => '#FF6B6B'
            ],
            [
                'nama_subsektor' => 'Desain Produk',
                'icon' => '🛠️',
                'color_code' => '#4ECDC4'
            ],
            [
                'nama_subsektor' => 'Kuliner',
                'icon' => '🍴',
                'color_code' => '#45B7D1'
            ],
            [
                'nama_subsektor' => 'Kriya',
                'icon' => '✋',
                'color_code' => '#96CEB4'
            ],
            [
                'nama_subsektor' => 'Seni Pertunjukan',
                'icon' => '🎭',
                'color_code' => '#FFEAA7'
            ],
            [
                'nama_subsektor' => 'Desain Interior',
                'icon' => '🪑',
                'color_code' => '#DDA0DD'
            ],
            [
                'nama_subsektor' => 'Fotografi',
                'icon' => '📷',
                'color_code' => '#98D8C8'
            ],
            [
                'nama_subsektor' => 'Musik',
                'icon' => '🎵',
                'color_code' => '#F7DC6F'
            ],
            [
                'nama_subsektor' => 'Penerbitan',
                'icon' => '📚',
                'color_code' => '#BB8FCE'
            ],
            [
                'nama_subsektor' => 'Aplikasi & Game',
                'icon' => '🎮',
                'color_code' => '#85C1E9'
            ],
            [
                'nama_subsektor' => 'Televisi & Radio',
                'icon' => '📺',
                'color_code' => '#F8C471'
            ],
            [
                'nama_subsektor' => 'Arsitektur',
                'icon' => '🏛️',
                'color_code' => '#82E0AA'
            ]
        ];

        foreach ($subsektors as $subsektor) {
            Subsektor::create([
                'nama_subsektor' => $subsektor['nama_subsektor'],
                'icon' => $subsektor['icon'],
                'color_code' => $subsektor['color_code']
            ]);
        }
    }
}
