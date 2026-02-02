<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Desa;
use App\Models\Kecamatan;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get kecamatan IDs
        $kecamatanIds = [];
        $kecamatans = Kecamatan::all();
        foreach ($kecamatans as $kecamatan) {
            $kecamatanIds[$kecamatan->nama_kecamatan] = $kecamatan->id;
        }

        $desas = [
            // Barangka
            ['nama_desa' => 'Barangka', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Bungkolo', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Lafinde', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Lapolea', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Sawerigadi', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Walelei', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Waulai', 'kecamatan_id' => $kecamatanIds['Barangka']],
            ['nama_desa' => 'Wuna', 'kecamatan_id' => $kecamatanIds['Barangka']],

            // Kusambi
            ['nama_desa' => 'Bakeramba', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Guali', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Kasakamu', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Kusambi', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Lakawoghe', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Lapokainse', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Lemoambo', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Sidamangura', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Tanjung Pinang', 'kecamatan_id' => $kecamatanIds['Kusambi']],
            ['nama_desa' => 'Konawe', 'kecamatan_id' => $kecamatanIds['Kusambi']], // kelurahan

            // Lawa
            ['nama_desa' => 'Lagadi', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Lalemba', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Latompe', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Latugho', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Madampi', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Watumela', 'kecamatan_id' => $kecamatanIds['Lawa']],
            ['nama_desa' => 'Lapadaku', 'kecamatan_id' => $kecamatanIds['Lawa']], // kelurahan
            ['nama_desa' => 'Wamelai', 'kecamatan_id' => $kecamatanIds['Lawa']], // kelurahan

            // Maginti
            ['nama_desa' => 'Abadi Jaya', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Bangko', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Gala', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Kangkunawe', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Kembar Maminasa', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Maginti', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Pajala', 'kecamatan_id' => $kecamatanIds['Maginti']],
            ['nama_desa' => 'Pasipadangan', 'kecamatan_id' => $kecamatanIds['Maginti']],

            // Napano Kusambi
            ['nama_desa' => 'Kombikuno', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],
            ['nama_desa' => 'Lahaji', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],
            ['nama_desa' => 'Latawe', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],
            ['nama_desa' => 'Masara', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],
            ['nama_desa' => 'Tangkumaho', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],
            ['nama_desa' => 'Umba', 'kecamatan_id' => $kecamatanIds['Napano Kusambi']],

            // Sawerigadi
            ['nama_desa' => 'Kampobalano', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Lakalamba', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Lawada Jaya', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Lombu Jaya', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Maperaha', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Marobea', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Nihi', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Ondoke', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Wakoila', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],
            ['nama_desa' => 'Waukuni', 'kecamatan_id' => $kecamatanIds['Sawerigadi']],

            // Tiworo Kepulauan
            ['nama_desa' => 'Katela', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Lasama', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Laworo', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Sidomakmur', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Wandoke', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Waturempe', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Wulanga Jaya', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']],
            ['nama_desa' => 'Tiworo', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']], // kelurahan
            ['nama_desa' => 'Waumere', 'kecamatan_id' => $kecamatanIds['Tiworo Kepulauan']], // kelurahan

            // Tiworo Selatan
            ['nama_desa' => 'Barakkah', 'kecamatan_id' => $kecamatanIds['Tiworo Selatan']],
            ['nama_desa' => 'Kasimpa Jaya', 'kecamatan_id' => $kecamatanIds['Tiworo Selatan']],
            ['nama_desa' => 'Katangana', 'kecamatan_id' => $kecamatanIds['Tiworo Selatan']],
            ['nama_desa' => 'Parura Jaya', 'kecamatan_id' => $kecamatanIds['Tiworo Selatan']],
            ['nama_desa' => 'Sangia Tiworo', 'kecamatan_id' => $kecamatanIds['Tiworo Selatan']],

            // Tiworo Tengah
            ['nama_desa' => 'Labokolo', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Lakabu', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Langku Langku', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Mekar Jaya', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Momuntu', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Suka Damai', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Wanseriwu', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],
            ['nama_desa' => 'Wapae', 'kecamatan_id' => $kecamatanIds['Tiworo Tengah']],

            // Tiworo Utara
            ['nama_desa' => 'Bero', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Mandike', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Santigi', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Santiri', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Tasipi', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Tiga', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],
            ['nama_desa' => 'Tondasi', 'kecamatan_id' => $kecamatanIds['Tiworo Utara']],

            // Wadaga
            ['nama_desa' => 'Kampani', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Katobu', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Lailangga', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Lakanaha', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Lasosodo', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Lindo', 'kecamatan_id' => $kecamatanIds['Wadaga']],
            ['nama_desa' => 'Wakontu', 'kecamatan_id' => $kecamatanIds['Wadaga']]
        ];

        foreach ($desas as $desa) {
            Desa::create([
                'nama_desa' => $desa['nama_desa'],
                'kecamatan_id' => $desa['kecamatan_id']
            ]);
        }
    }
}
