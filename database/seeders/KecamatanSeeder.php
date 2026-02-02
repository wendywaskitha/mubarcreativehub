<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            [
                'nama_kecamatan' => 'Barangka',
                'latitude' => '-5.1667',
                'longitude' => '122.6667'
            ],
            [
                'nama_kecamatan' => 'Kusambi',
                'latitude' => '-5.2000',
                'longitude' => '122.7000'
            ],
            [
                'nama_kecamatan' => 'Lawa',
                'latitude' => '-5.2333',
                'longitude' => '122.7333'
            ],
            [
                'nama_kecamatan' => 'Maginti',
                'latitude' => '-5.2667',
                'longitude' => '122.7667'
            ],
            [
                'nama_kecamatan' => 'Napano Kusambi',
                'latitude' => '-5.3000',
                'longitude' => '122.8000'
            ],
            [
                'nama_kecamatan' => 'Sawerigadi',
                'latitude' => '-5.3333',
                'longitude' => '122.8333'
            ],
            [
                'nama_kecamatan' => 'Tiworo Kepulauan',
                'latitude' => '-5.3667',
                'longitude' => '122.8667'
            ],
            [
                'nama_kecamatan' => 'Tiworo Selatan',
                'latitude' => '-5.4000',
                'longitude' => '122.9000'
            ],
            [
                'nama_kecamatan' => 'Tiworo Tengah',
                'latitude' => '-5.4333',
                'longitude' => '122.9333'
            ],
            [
                'nama_kecamatan' => 'Tiworo Utara',
                'latitude' => '-5.4667',
                'longitude' => '122.9667'
            ],
            [
                'nama_kecamatan' => 'Wadaga',
                'latitude' => '-5.5000',
                'longitude' => '123.0000'
            ]
        ];

        foreach ($kecamatans as $kecamatan) {
            Kecamatan::create([
                'nama_kecamatan' => $kecamatan['nama_kecamatan'],
                'latitude' => $kecamatan['latitude'],
                'longitude' => $kecamatan['longitude']
            ]);
        }
    }
}
