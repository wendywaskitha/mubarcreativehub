<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\UMKM;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get UMKM IDs for relationships
        $umkmIds = UMKM::pluck('id')->toArray();

        // Sample Produk data
        $produks = [
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Kain Tenun Motif Bunga',
                'slug' => 'kain-tenun-motif-bunga',
                'deskripsi' => 'Kain tenun tradisional dengan motif bunga yang indah dan bermakna budaya.',
                'harga' => 150000,
                'stok' => 20,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Fashion',
                'tags' => json_encode(['tradisional', 'khas', 'muna']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Kursi Kayu Jati',
                'slug' => 'kursi-kayu-jati',
                'deskripsi' => 'Kursi minimalis dengan bahan kayu jati pilihan, kuat dan tahan lama.',
                'harga' => 850000,
                'stok' => 10,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Meubel',
                'tags' => json_encode(['minimalis', 'kuat', 'jati']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Nasi Goreng Spesial',
                'slug' => 'nasi-goreng-spesial',
                'deskripsi' => 'Nasi goreng dengan bumbu rahasia dan bahan-bahan segar pilihan.',
                'harga' => 35000,
                'stok' => 50,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Kuliner',
                'tags' => json_encode(['spesial', 'pedas', 'lezaat']),
                'status_tersedia' => true,
                'is_featured' => false,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Keranjang Bambu',
                'slug' => 'keranjang-bambu',
                'deskripsi' => 'Keranjang anyaman bambu yang ramah lingkungan dan estetik.',
                'harga' => 75000,
                'stok' => 30,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Kriya',
                'tags' => json_encode(['ramah-lingkungan', 'unik', 'bambu']),
                'status_tersedia' => true,
                'is_featured' => false,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Album Musik Tradisional',
                'slug' => 'album-musik-tradisional',
                'deskripsi' => 'Album musik tradisional Muna dengan sentuhan modern.',
                'harga' => 120000,
                'stok' => 15,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Musik',
                'tags' => json_encode(['tradisional', 'modern', 'muna']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Desain Interior Ruang Tamu',
                'slug' => 'desain-interior-ruang-tamu',
                'deskripsi' => 'Jasa desain interior ruang tamu dengan gaya modern minimalis.',
                'harga' => 5000000,
                'stok' => 5,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Desain Interior',
                'tags' => json_encode(['interior', 'minimalis', 'ruang-tamu']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Sesi Foto PreWedding',
                'slug' => 'sesi-foto-prewedding',
                'deskripsi' => 'Paket sesi foto prewedding dengan tim profesional.',
                'harga' => 3000000,
                'stok' => 8,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Fotografi',
                'tags' => json_encode(['prewedding', 'professional', 'momen-indah']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Buku Cerita Rakyat Muna',
                'slug' => 'buku-cerita-rakyat-muna',
                'deskripsi' => 'Kumpulan cerita rakyat Muna dalam bentuk buku yang menarik.',
                'harga' => 85000,
                'stok' => 25,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Penerbitan',
                'tags' => json_encode(['cerita-rakyat', 'budaya', 'muna']),
                'status_tersedia' => true,
                'is_featured' => false,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Game Edukasi Budaya',
                'slug' => 'game-edukasi-budaya',
                'deskripsi' => 'Game edukasi yang mengenalkan budaya Muna Barat kepada anak-anak.',
                'harga' => 75000,
                'stok' => 100,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Aplikasi & Game',
                'tags' => json_encode(['edukasi', 'budaya', 'anak']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ],
            [
                'umkm_id' => $umkmIds[array_rand($umkmIds)],
                'nama_produk' => 'Kemeja Tenun Premium',
                'slug' => 'kemeja-tenun-premium',
                'deskripsi' => 'Kemeja dengan bahan tenun premium khas Muna Barat.',
                'harga' => 450000,
                'stok' => 12,
                'foto_1' => null,
                'foto_2' => null,
                'foto_3' => null,
                'foto_4' => null,
                'foto_5' => null,
                'kategori' => 'Fashion',
                'tags' => json_encode(['premium', 'formal', 'khas']),
                'status_tersedia' => true,
                'is_featured' => true,
                'views' => rand(50, 500)
            ]
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
