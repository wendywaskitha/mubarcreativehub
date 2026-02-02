<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Article data
        $articles = [
            [
                'judul' => 'Potensi Ekonomi Kreatif di Muna Barat',
                'slug' => 'potensi-ekonomi-kreatif-di-muna-barat',
                'konten' => '<p>Kabupaten Muna Barat memiliki potensi besar dalam pengembangan ekonomi kreatif. Dengan berbagai subsektor seperti fashion, kuliner, kriya, dan seni pertunjukan, para pelaku UMKM memiliki peluang luas untuk berkembang.</p>
                <p>Berbagai program pemerintah juga turut mendukung pengembangan sektor ini, termasuk pelatihan keterampilan, akses permodalan, dan pemasaran produk secara digital.</p>',
                'kategori' => 'Tips',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'UMKM Tenun Tradisional Raih Penghargaan Nasional',
                'slug' => 'umkm-tenun-tradisional-raih-penghargaan-nasional',
                'konten' => '<p>Salah satu pelaku UMKM di bidang tenun tradisional dari Muna Barat berhasil meraih penghargaan nasional dalam ajang Anugerah Ekraf Nusantara 2024. Prestasi ini membuktikan bahwa produk lokal memiliki daya saing tinggi di pasar nasional maupun internasional.</p>
                <p>Penghargaan ini diharapkan dapat memotivasi pelaku UMKM lainnya untuk terus meningkatkan kualitas produk dan inovasi dalam berkarya.</p>',
                'kategori' => 'Cerita UMKM',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Festival Kuliner Muna Barat Akan Digelar Bulan Depan',
                'slug' => 'festival-kuliner-muna-barat-akan-digelar-bulan-depan',
                'konten' => '<p>Festival kuliner tahunan akan segera digelar di Muna Barat bulan depan. Acara ini akan menampilkan berbagai makanan khas daerah serta memberikan kesempatan bagi pelaku UMKM kuliner untuk memperkenalkan produk mereka.</p>
                <p>Festival ini juga menjadi ajang promosi pariwisata dan ekonomi kreatif di wilayah tersebut.</p>',
                'kategori' => 'Event',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Strategi Pemasaran Produk Kreatif di Era Digital',
                'slug' => 'strategi-pemasaran-produk-kreatif-di-era-digital',
                'konten' => '<p>Dalam era digital seperti sekarang, pelaku UMKM perlu mengadopsi strategi pemasaran online untuk menjangkau pasar yang lebih luas. Pemanfaatan media sosial, marketplace, dan website menjadi sangat penting.</p>
                <p>Platform seperti Instagram, TikTok, dan WhatsApp Business dapat menjadi sarana efektif untuk mempromosikan produk kreatif secara gratis dan mudah.</p>',
                'kategori' => 'Tips',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'UMKM Mebel Lokal Ekspor ke Luar Negeri',
                'slug' => 'umkm-mebel-lokal-ekspor-ke-luar-negeri',
                'konten' => '<p>Sebuah UMKM mebel di Muna Barat berhasil melakukan ekspor produknya ke beberapa negara Asia Tenggara. Produk-produk yang terbuat dari kayu jati lokal ini diminati karena kualitasnya yang tinggi dan desain yang unik.</p>
                <p>Kisah sukses ini menjadi inspirasi bagi pelaku UMKM lainnya untuk tidak hanya berorientasi pasar lokal tetapi juga global.</p>',
                'kategori' => 'Cerita UMKM',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Pelatihan Fotografi untuk UMKM di Muna Barat',
                'slug' => 'pelatihan-fotografi-untuk-umkm-di-muna-barat',
                'konten' => '<p>Dinas Pariwisata dan Ekonomi Kreatif Muna Barat menyelenggarakan pelatihan fotografi untuk pelaku UMKM. Pelatihan ini bertujuan meningkatkan kualitas visual produk yang akan dipromosikan secara online.</p>
                <p>Peserta belajar teknik dasar fotografi, pencahayaan, dan editing sederhana untuk membuat konten visual yang menarik.</p>',
                'kategori' => 'Event',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Manfaat Memiliki NIB untuk UMKM',
                'slug' => 'manfaat-memiliki-nib-untuk-umkm',
                'konten' => '<p>Nomor Induk Berusaha (NIB) merupakan identitas tunggal bagi pelaku usaha mikro, kecil, dan menengah. Dengan memiliki NIB, UMKM dapat mengakses berbagai kemudahan dan fasilitas dari pemerintah.</p>
                <p>Beberapa manfaat memiliki NIB antara lain kemudahan dalam perizinan, akses permodalan, dan program bantuan pemerintah.</p>',
                'kategori' => 'Tips',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'UMKM Kerajinan Bambu Raup Omzet Puluhan Juta',
                'slug' => 'umkm-kerajinan-bambu-raup-omzet-puluhan-juta',
                'konten' => '<p>Sebuah UMKM kerajinan bambu di Muna Barat berhasil meraih omzet puluhan juta rupiah per bulan. Produk-produk yang terbuat dari bambu lokal ini diminati tidak hanya di pasar domestik tetapi juga diekspor ke beberapa negara.</p>
                <p>Keberhasilan ini menunjukkan bahwa produk kreatif dari bahan alami memiliki potensi besar di pasar global.</p>',
                'kategori' => 'Cerita UMKM',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Workshop Desain Grafis untuk Pelaku UMKM',
                'slug' => 'workshop-desain-grafis-untuk-pelaku-umkm',
                'konten' => '<p>Untuk meningkatkan kapasitas pelaku UMKM dalam bidang pemasaran digital, diselenggarakan workshop desain grafis. Workshop ini membahas dasar-dasar desain, pembuatan logo, dan pembuatan konten visual untuk media sosial.</p>
                <p>Harapannya, pelaku UMKM dapat membuat konten promosi yang menarik secara mandiri.</p>',
                'kategori' => 'Event',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ],
            [
                'judul' => 'Tren Fashion Tenun Modern di Kalangan Milenial',
                'slug' => 'tren-fashion-tenun-modern-di-kalangan-milenial',
                'konten' => '<p>Tenun tradisional kini mulai diminati kalangan milenial dengan desain yang lebih modern dan kontemporer. Para desainer muda di Muna Barat mulai menciptakan koleksi fashion yang menggabungkan motif tradisional dengan siluet modern.</p>
                <p>Inovasi ini membuka peluang baru bagi pelaku UMKM tekstil untuk menembus pasar yang lebih luas.</p>',
                'kategori' => 'Berita',
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
