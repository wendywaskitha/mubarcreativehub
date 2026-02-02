# Tugas Pembuatan Aplikasi Web "Mubar Creative Hub"

Berikut adalah daftar tugas untuk membuat aplikasi berbasis web sesuai dengan Product Requirements Document (PRD) tentang Aplikasi Promosi Pariwisata Ekonomi Kreatif Kabupaten Muna Barat menggunakan Laravel dengan frontend Blade Templates dan Bootstrap 5.

## 1. Persiapan Awal

- [ ] Buat struktur proyek Laravel 12
- [ ] Instalasi dan konfigurasi FilamentPHP 3.3
- [ ] Konfigurasi database MySQL
- [ ] Setup Bootstrap 5
- [ ] Setup Blade templates
- [ ] Konfigurasi environment development

## 2. Pembuatan Database dan Model

- [x] Buat migrasi tabel `umkm`
- [x] Buat migrasi tabel `produk`
- [x] Buat migrasi tabel `kecamatan`
- [x] Buat migrasi tabel `desa`
- [x] Buat migrasi tabel `subsektor`
- [x] Buat migrasi tabel `articles`
- [x] Buat migrasi tabel `banners`
- [x] Buat migrasi tabel `settings`
- [x] Buat model-model sesuai dengan skema database
- [x] Definisikan relasi antar model
- [x] Tetapkan foreign key relationship antara `umkm` dan `desa`
- [x] Tetapkan foreign key relationship antara `desa` dan `kecamatan`

### Skema Database untuk Tabel Desa
- [x] Tabel `desa` harus memiliki kolom: id, nama_desa, kecamatan_id, created_at, updated_at
- [x] Tabel `umkm` harus memiliki kolom: id, nama_usaha, nama_pemilik, jenis_subsektor, alamat_usaha, kecamatan_id, desa_id, tahun_berdiri, jumlah_tenaga_kerja, omset_tahun, no_telp, email, jenis_badan_usaha, jenis_hki, nib, facebook, instagram, tiktok, whatsapp, website, logo, latitude, longitude, deskripsi, status_aktif, status_verifikasi, views, created_at, updated_at

## 3. Import Data Awal

- [x] Buat seeder untuk data kecamatan (11 kecamatan)
- [x] Buat seeder untuk data desa sesuai kecamatan
- [x] Buat seeder untuk data subsektor
- [x] Import data 120+ UMKM dari file Excel ke database
- [x] Validasi data yang diimport

## 4. Pembuatan Admin Panel (FilamentPHP)

- [x] Buat resource UMKM dengan semua field sesuai PRD termasuk desa
- [x] Tambahkan fitur map picker untuk latitude dan longitude
- [x] Buat resource Produk dengan relasi ke UMKM
- [x] Buat resource Desa dengan relasi ke kecamatan
- [x] Buat resource Artikel/Blog
- [x] Buat resource Banner
- [x] Buat halaman settings dengan tabs
- [x] Implementasi dashboard admin dengan widgets statistik
- [ ] Tambahkan fitur export data (Excel/PDF)
- [ ] Tambahkan fitur bulk import Excel

## 5. Pembuatan Halaman Publik dengan Blade dan Bootstrap 5

- [x] Buat layout utama menggunakan Blade dan Bootstrap 5
- [x] Buat homepage dengan hero banner slider menggunakan Bootstrap Carousel
- [x] Implementasi search bar dan filter kategori dengan Bootstrap components
- [x] Tampilkan featured UMKM dalam card layout Bootstrap
- [x] Tambahkan mini peta interaktif di homepage
- [x] Buat halaman katalog UMKM dengan grid/list view menggunakan Bootstrap grid system
- [x] Implementasi filter berdasarkan kecamatan, desa dan subsektor dengan Bootstrap forms
- [x] Implementasi sorting (terbaru, terlama, A-Z, populer) dengan dropdown Bootstrap
- [x] Buat halaman detail UMKM dengan informasi lengkap menggunakan Bootstrap cards dan typography
- [x] Tambahkan tombol WhatsApp click-to-chat di halaman UMKM dengan styling Bootstrap
- [x] Buat halaman detail produk dengan Bootstrap modal dan card components
- [x] Tambahkan tombol pesan via WhatsApp di halaman produk dengan styling Bootstrap

## 6. Integrasi Peta Interaktif (Leaflet JS) dengan Bootstrap 5

- [x] Instalasi Leaflet JS melalui npm
- [x] Import CSS dan JS Leaflet ke dalam proyek
- [x] Buat halaman peta penuh dengan Leaflet dan layout Bootstrap 5
- [x] Implementasi marker UMKM dengan custom icon per kategori
- [x] Tambahkan marker clustering untuk area padat
- [x] Implementasi popup informasi saat klik marker termasuk informasi desa
- [x] Tambahkan fitur filter peta berdasarkan kategori, kecamatan dan desa dengan komponen form Bootstrap
- [x] Implementasi search box untuk mencari UMKM di peta dengan input group Bootstrap
- [x] Tambahkan fitur geolocation untuk menemukan lokasi pengguna
- [x] Styling elemen peta menggunakan komponen dan utility Bootstrap

## 7. Integrasi WhatsApp dengan Bootstrap 5

- [x] Buat fungsi helper untuk format nomor telepon (0812 → 62812)
- [x] Implementasi WhatsApp Click-to-Chat untuk UMKM dengan tombol Bootstrap
- [x] Implementasi WhatsApp Click-to-Chat untuk produk dengan tombol Bootstrap
- [x] Tambahkan floating WhatsApp button di seluruh halaman dengan positioning Bootstrap
- [x] Buat pre-filled message untuk komunikasi dengan UMKM
- [x] Styling WhatsApp button menggunakan kelas-kelas Bootstrap

## 8. Fitur Tambahan dengan Bootstrap 5

- [x] Implementasi fitur share ke sosial media dengan komponen Bootstrap
- [x] Buat breadcrumb navigation menggunakan komponen Bootstrap
- [x] Tambahkan fitur lazy loading untuk gambar
- [x] Optimasi gambar ke format WebP
- [x] Implementasi SEO-friendly URLs
- [x] Tambahkan meta tags untuk SEO
- [x] Gunakan komponen-komponen Bootstrap seperti alert, badge, progress bar untuk UI

## 9. Responsive Design dengan Bootstrap 5

- [x] Pastikan semua halaman tampil dengan baik di mobile menggunakan grid system Bootstrap 5
- [x] Implementasi mobile-first design dengan breakpoint Bootstrap
- [x] Uji tampilan di berbagai ukuran layar menggunakan utility classes Bootstrap
- [x] Optimasi navigasi untuk mobile dengan navbar collapse Bootstrap

## 10. Testing dan Optimasi

- [ ] Lakukan testing fungsionalitas
- [ ] Uji kecepatan loading halaman (< 3 detik)
- [ ] Uji rendering peta dengan 120+ markers (< 2 detik)
- [ ] Lakukan optimasi performa
- [ ] Pastikan semua fitur berjalan di browser modern
- [ ] Lakukan uji coba user acceptance (UAT)

## 11. Keamanan dan Validasi

- [ ] Implementasi CSRF protection
- [ ] Validasi input form
- [ ] Sanitasi data input
- [ ] Pastikan SSL certificate aktif
- [ ] Proteksi admin panel

## 12. Deployment

- [ ] Siapkan server production
- [ ] Deploy aplikasi ke production
- [ ] Konfigurasi domain dan SSL
- [ ] Lakukan testing pasca-deployment
- [ ] Dokumentasi deployment

## 13. Dokumentasi dan Pelatihan

- [ ] Buat dokumentasi teknis
- [ ] Siapkan materi pelatihan untuk Super Admin
- [ ] Buat user manual untuk penggunaan aplikasi
- [ ] Dokumentasi API jika diperlukan