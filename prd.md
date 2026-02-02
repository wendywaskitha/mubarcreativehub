Berikut adalah **PRD Revisi** berdasarkan feedback Anda (hanya Super Admin, tanpa destinasi wisata, tanpa e-commerce, transaksi via WhatsApp, dan menggunakan Leaflet JS): [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

# Product Requirements Document (PRD) - REVISI
## Aplikasi Promosi Pariwisata Ekonomi Kreatif Kabupaten Muna Barat

***

## 1. Executive Summary

### 1.1 Tujuan Produk
Mengembangkan platform web katalog digital untuk mempromosikan 120+ pelaku ekonomi kreatif di Kabupaten Muna Barat, memudahkan wisatawan menemukan UMKM, dan menghubungkan pembeli langsung ke pelaku usaha melalui WhatsApp. [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)

### 1.2 Latar Belakang
Kabupaten Muna Barat memiliki 120+ pelaku ekonomi kreatif tersebar di 11 kecamatan dengan beragam subsektor (Tenun, Meubel, Kuliner, Kriya, Seni Pertunjukan, dll) yang memerlukan platform promosi digital terintegrasi tanpa kompleksitas e-commerce. [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

### 1.3 Target Pengguna
- **Primary**: Wisatawan dan pembeli (visitor/umum)
- **Secondary**: Dinas Pariwisata/Disperindag (Super Admin)
- **Tertiary**: Pelaku UMKM (penerima inquiry via WhatsApp)

***

## 2. Problem Statement

### 2.1 Masalah yang Diselesaikan
- Minimnya visibilitas produk ekonomi kreatif lokal [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Kesulitan wisatawan menemukan lokasi dan kontak UMKM [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Tidak ada database terpusat pelaku ekonomi kreatif [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Transaksi masih manual via WhatsApp tanpa sistem pendukung [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

### 2.2 Value Proposition
Platform katalog digital sederhana dengan peta interaktif dan integrasi WhatsApp langsung untuk transaksi cepat tanpa proses checkout kompleks. [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)

***

## 3. Product Overview

### 3.1 Nama Aplikasi
**"Mubar Creative Hub"** - Katalog Digital Ekonomi Kreatif Muna Barat

### 3.2 Teknologi Stack
- **Backend**: Laravel 12 [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- **Admin Panel**: FilamentPHP 3.3+ [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- **Frontend**: Blade Template + Tailwind CSS [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- **Database**: MySQL
- **Maps**: Leaflet JS (Open Source) [learnlaravel](https://learnlaravel.net/1253/adding-interactive-maps-to-laravel-with-leaflet-js-step-2-installing-leaflet-with-laravel-mix/)
- **Tile Layer**: OpenStreetMap [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
- **WhatsApp Integration**: Click-to-Chat API [faq.whatsapp](https://faq.whatsapp.com/5913398998672934)

***

## 4. User Roles & Permissions

### **Role: Super Admin (Dinas Pariwisata/Disperindag)**

| Fungsi | Deskripsi |
|--------|-----------|
| **Kelola UMKM** | CRUD data UMKM (tambah, edit, hapus, verifikasi)  [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx) |
| **Kelola Produk** | CRUD produk untuk semua UMKM |
| **Kelola Konten** | Banner homepage, artikel blog, galeri |
| **Dashboard Analytics** | Statistik kunjungan, UMKM populer, breakdown per kecamatan |
| **Export Data** | Download laporan Excel/PDF  [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx) |
| **Setting Sistem** | Konfigurasi website (meta, social media, kontak) |

### **Role: Visitor (Tidak Perlu Login)**

| Fungsi | Deskripsi |
|--------|-----------|
| **Browse Katalog** | Lihat semua UMKM dan produk |
| **Search & Filter** | Cari berdasarkan nama, kategori, lokasi |
| **Lihat Peta** | Eksplorasi peta interaktif Leaflet JS  [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022) |
| **Kontak via WhatsApp** | Klik tombol WhatsApp untuk chat langsung  [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat) |
| **Share Produk** | Share ke social media (Facebook, Twitter, WhatsApp) |

***

## 5. Functional Requirements

### 5.1 Modul Katalog UMKM & Produk

#### A. Halaman Directory UMKM
**Fitur:**
- Grid/List view dengan foto, nama usaha, kategori, lokasi [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Badge kategori (Tenun, Meubel, Kuliner, Kriya, dll) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Quick info: Kecamatan, Tahun Berdiri, Rating (future) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Button "Lihat Detail" dan "Chat WhatsApp" [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)

**Filter:**
- Dropdown kecamatan (11 kecamatan) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Checkbox subsektor (Fashion/Tenun, Desain Produk, Kuliner, Kriya, Seni Pertunjukan, Desain Interior, Fotografi, Musik, Penerbitan) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Range omset (Rp 0-10jt, 10-50jt, 50-100jt, >100jt) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

**Sort:**
- Terbaru, Terlama, Nama A-Z, Populer (berdasarkan views)

#### B. Detail Page UMKM
**Informasi Ditampilkan:**
- Nama usaha & pemilik [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Kategori/subsektor [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Alamat lengkap (Desa, Kecamatan) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Tahun berdiri & jumlah tenaga kerja [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Omset per tahun (optional hide) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Jenis badan usaha (Perseorangan, CV, UD, Kelompok) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- NIB & HKI (jika ada) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Logo/foto usaha
- Deskripsi singkat usaha

**Call to Action:**
- Tombol "Chat WhatsApp" (primary) dengan format `https://wa.me/62xxx?text=Halo%20[Nama%20Usaha]` [faq.whatsapp](https://faq.whatsapp.com/5913398998672934)
- Tombol Social Media (Facebook, Instagram, TikTok) jika tersedia [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Tombol "Lihat di Peta" (scroll ke map dengan marker focused)
- Tombol "Share" (copy link, WA, FB, Twitter)

**Galeri Produk:**
- Tampilkan produk-produk dari UMKM ini (grid 3-4 kolom)
- Foto produk, nama, harga
- Klik produk = detail produk

#### C. Detail Page Produk
**Informasi:**
- Gallery foto produk (slider)
- Nama produk & harga
- Deskripsi detail (bahan, ukuran, warna, keunikan)
- Stok tersedia/habis (badge)
- Kategori/tag
- Informasi UMKM (mini card)

**Call to Action:**
- Tombol "Pesan via WhatsApp" dengan pre-filled message: `Halo [Nama UMKM], saya tertarik dengan produk [Nama Produk] seharga [Harga]. Apakah masih tersedia?` [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)
- Tombol "Lihat Produk Lainnya" dari UMKM ini
- Tombol "Share Produk"

***

### 5.2 Modul Peta Interaktif (Leaflet JS)

#### Implementasi Leaflet JS: [learnlaravel](https://learnlaravel.net/1253/adding-interactive-maps-to-laravel-with-leaflet-js-step-2-installing-leaflet-with-laravel-mix/)

**Setup:**
```javascript
// Install via NPM
npm install leaflet

// Import di resources/js/app.js
require('leaflet/dist/leaflet.js');

// Import CSS di resources/sass/app.scss
@import "~leaflet/dist/leaflet.css";
```

**Fitur Peta:**

1. **Base Map Layer**
   - Tile Layer: OpenStreetMap [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
   - Center: Koordinat Kabupaten Muna Barat (approx: -5.15, 122.75)
   - Zoom level: 10-11

2. **Marker UMKM** [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
   - Custom icon per kategori:
     - Tenun: 🧵 icon
     - Kuliner: 🍴 icon
     - Meubel: 🪑 icon
     - Kriya: ✋ icon
     - Seni Pertunjukan: 🎭 icon
     - dll
   - Marker clustering untuk area padat [youtube](https://www.youtube.com/watch?v=LxenV0YaX8M)
   - Data marker dari controller (pass via Blade):

```php
// Controller
$umkmLocations = UMKM::select('id', 'nama_usaha', 'latitude', 'longitude', 'jenis_subsektor')
    ->whereNotNull('latitude')
    ->get();
return view('map', compact('umkmLocations'));
```

3. **Popup Information** [youtube](https://www.youtube.com/watch?v=LxenV0YaX8M)
   - Klik marker = popup dengan:
     - Foto UMKM (thumbnail)
     - Nama usaha
     - Kategori
     - Alamat singkat
     - Button "Lihat Detail" → link ke detail page
     - Button "Chat WA" → direct WhatsApp [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)

4. **Filter Peta**
   - Checkbox kategori subsektor (tampilkan/sembunyikan marker)
   - Dropdown kecamatan (fly to + filter)
   - Search box (cari nama UMKM, zoom ke marker)

5. **Geolocation** (Optional)
   - Button "Lokasi Saya" untuk detect user location
   - Tampilkan UMKM terdekat

**Code Example Leaflet Integration**: [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)

```javascript
// Initialize Map
let map = L.map('map').setView([-5.15, 122.75], 11);

// Add OpenStreetMap Tile Layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Add Markers dari data Laravel
const umkmData = @json($umkmLocations);
umkmData.forEach(umkm => {
    if(umkm.latitude && umkm.longitude) {
        let marker = L.marker([umkm.latitude, umkm.longitude])
            .bindPopup(`
                <div class="popup-content">
                    <h3>${umkm.nama_usaha}</h3>
                    <p><strong>${umkm.jenis_subsektor}</strong></p>
                    <a href="/umkm/${umkm.id}" class="btn btn-sm">Lihat Detail</a>
                    <a href="https://wa.me/${umkm.no_telp}" class="btn btn-sm btn-success">Chat WA</a>
                </div>
            `)
            .addTo(map);
    }
});
```

***

### 5.3 Modul WhatsApp Integration

#### A. WhatsApp Click-to-Chat [faq.whatsapp](https://faq.whatsapp.com/5913398998672934)

**Format URL:**
```
https://wa.me/<phone_number>?text=<message>
```

**Implementasi di Blade:**

```php
{{-- Button WhatsApp UMKM --}}
<a href="https://wa.me/{{ formatPhoneNumber($umkm->no_telp) }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20ingin%20bertanya%20tentang%20produk%20Anda." 
   target="_blank"
   class="btn btn-success">
    <i class="fab fa-whatsapp"></i> Chat WhatsApp
</a>

{{-- Helper Function di Controller/Helper --}}
function formatPhoneNumber($phone) {
    // Convert 0812xxx → 62812xxx
    $phone = preg_replace('/^0/', '62', $phone);
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return $phone;
}
```

**Button untuk Produk:**
```php
<a href="https://wa.me/{{ formatPhoneNumber($umkm->no_telp) }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20*{{ urlencode($produk->nama_produk) }}*%20seharga%20Rp{{ number_format($produk->harga) }}.%20Apakah%20masih%20tersedia%3F" 
   target="_blank"
   class="btn btn-success btn-lg">
    <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
</a>
```

#### B. Floating WhatsApp Button
- Sticky button di kanan bawah halaman
- Link ke WhatsApp CS Dinas Pariwisata untuk pertanyaan umum

***

### 5.4 Modul Admin Panel (FilamentPHP)

#### Dashboard Super Admin

**Widgets:**
1. **Statistik Cards**
   - Total UMKM terdaftar [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
   - Total produk
   - Total views bulan ini
   - UMKM terpopuler (most viewed)

2. **Chart Analytics**
   - Bar chart: UMKM per kecamatan [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
   - Pie chart: UMKM per subsektor [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
   - Line chart: Growth UMKM per tahun [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
   - Line chart: Website traffic (jika ada Google Analytics)

3. **Recent Activities**
   - UMKM baru ditambahkan
   - Produk baru diupload
   - UMKM yang perlu verifikasi

#### Resource: UMKM Management

**Fields (sesuai Excel)**: [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Text Input: Nama Usaha, Nama Pemilik
- Select: Jenis Subsektor (options: Tenun, Meubel, Kuliner, dll)
- Textarea: Alamat Usaha
- Select: Kecamatan (11 options)
- Text Input: Desa
- Number: Tahun Berdiri
- Number: Jumlah Tenaga Kerja
- Number: Omset per Tahun
- Text Input: No. Telp (dengan validasi format)
- Email Input: Email
- Select: Jenis Badan Usaha (Perseorangan, CV, PT, UD, Kelompok, Komunitas)
- Text Input: Jenis HKI (optional)
- Text Input: NIB (optional)
- Textarea: Social Media (FB, IG, TikTok, WhatsApp)
- File Upload: Logo/Foto Usaha (max 2MB)
- Text Input: Latitude (optional, auto-fill via map picker)
- Text Input: Longitude (optional, auto-fill via map picker)
- Toggle: Status Aktif/Non-aktif
- Toggle: Status Verifikasi

**Actions:**
- Bulk import Excel (untuk update data)
- Export Excel/PDF
- Verify/Unverify (batch action)

**Map Picker untuk Lat/Long:**
- Integrate Filament Map Picker plugin atau custom Leaflet widget
- Admin bisa klik peta untuk set koordinat UMKM

#### Resource: Produk Management

**Fields:**
- Select: UMKM (relationship)
- Text Input: Nama Produk
- Rich Editor: Deskripsi
- Number: Harga
- Number: Stok
- File Upload: Foto Produk (multiple, max 5 foto)
- Select: Kategori Produk (custom atau sama dengan subsektor)
- Tag Input: Tags
- Toggle: Status Tersedia/Habis
- Toggle: Featured Product (tampil di homepage)

**Relation Manager:**
- Dari UMKM detail page, tampilkan list produk
- Quick add produk tanpa pindah halaman

#### Resource: Blog/Artikel

**Fields:**
- Text Input: Judul
- Slug (auto-generate)
- Rich Editor: Konten
- File Upload: Featured Image
- Select: Kategori Artikel (Tips, Cerita UMKM, Event, dll)
- Toggle: Publish/Draft
- DateTime: Tanggal Publish

#### Resource: Banner Management

**Fields:**
- File Upload: Banner Image (desktop & mobile)
- Text Input: Judul Banner
- Text Input: Subtitle
- Text Input: Button Text
- Text Input: Button Link
- Number: Order (untuk sorting)
- Toggle: Active/Inactive

#### Settings Page

**Tabs:**
1. **General**
   - Site Title, Tagline, Description (SEO)
   - Logo, Favicon
   - Contact Info (alamat, telp, email dinas)

2. **Social Media**
   - Facebook, Instagram, Twitter, YouTube links

3. **WhatsApp CS**
   - Nomor WhatsApp CS Dinas
   - Default message template

4. **Analytics**
   - Google Analytics ID
   - Meta Pixel ID (optional)

***

## 6. Non-Functional Requirements

### 6.1 Performance
- Page load time < 3 detik
- Leaflet map render < 2 detik untuk 120+ markers [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
- Lazy loading untuk foto produk
- Image optimization (WebP format)

### 6.2 Security
- SSL Certificate (HTTPS)
- CSRF protection (Laravel default)
- Input sanitization
- Admin panel protected dengan 2FA (optional)

### 6.3 Usability
- Fully responsive (mobile-first design)
- SEO-friendly URLs
- Breadcrumb navigation
- Accessible (color contrast, alt text, keyboard navigation)

### 6.4 Scalability
- Support hingga 500+ UMKM tanpa performance degradation
- Database indexing (latitude, longitude, kategori)
- CDN untuk static assets

***

## 7. User Stories

### Visitor:
1. "Saya ingin mencari pengrajin tenun di Barangka dan langsung chat via WhatsApp" [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)
2. "Saya ingin lihat peta UMKM kuliner terdekat dengan lokasi saya" [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
3. "Saya ingin share produk meubel menarik ke grup Facebook saya"

### Super Admin:
1. "Saya ingin tambah data UMKM baru dengan koordinat lewat peta interaktif" [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
2. "Saya ingin export data semua UMKM ke Excel untuk laporan bulanan" [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
3. "Saya ingin melihat statistik UMKM mana yang paling banyak dikunjungi"

***

## 8. Wireframe & User Flow

### 8.1 Homepage
```
[Hero Banner Slider]
[Search Bar + Filter Kategori]
[Featured UMKM - Grid 4 kolom]
[Mini Peta Interaktif]
[Kategori Subsektor - Icon Grid]
[Blog/Artikel Terbaru]
[Statistik Counter: Total UMKM, Total Produk, Total Kecamatan]
[Footer: Kontak Dinas, Social Media, WhatsApp CS]
```

### 8.2 Halaman Katalog UMKM
```
[Breadcrumb: Home > Katalog UMKM]
[Filter Sidebar]
  - Kecamatan
  - Subsektor
  - Range Omset
[Sort Dropdown]
[Grid/List View Toggle]
[UMKM Cards dengan WhatsApp Button]
[Pagination]
```

### 8.3 Detail UMKM
```
[Breadcrumb: Home > Katalog > [Nama UMKM]]
[Gallery Foto (Slider)]
[Info UMKM - 2 kolom]
  Kiri: Nama, Pemilik, Kategori, Alamat, Tahun Berdiri, Tenaga Kerja
  Kanan: Kontak (Telp, Email, Social Media)
[CTA Buttons: Chat WhatsApp | Lihat di Peta | Share]
[Deskripsi Usaha]
[Produk dari UMKM ini]
[Mini Map dengan 1 marker]
[UMKM Terkait (kategori sama)]
```

### 8.4 Halaman Peta
```
[Fullscreen Map dengan Leaflet JS]
[Sidebar Filter:
  - Checkbox per Subsektor
  - Dropdown Kecamatan
  - Search Box
  - Button "Lokasi Saya"
]
[Legend Marker]
[Popup saat marker diklik]
```

***

## 9. Database Schema

### Tabel: `umkm`
```sql
id, nama_usaha, nama_pemilik, jenis_subsektor, alamat_usaha, 
kecamatan_id, desa, tahun_berdiri, jumlah_tenaga_kerja, 
omset_tahun, no_telp, email, jenis_badan_usaha, jenis_hki, 
nib, facebook, instagram, tiktok, whatsapp, website, 
logo, latitude, longitude, deskripsi, status_aktif, 
status_verifikasi, views, created_at, updated_at
```

### Tabel: `produk`
```sql
id, umkm_id, nama_produk, slug, deskripsi, harga, stok, 
foto_1, foto_2, foto_3, foto_4, foto_5, kategori, tags, 
status_tersedia, is_featured, views, created_at, updated_at
```

### Tabel: `kecamatan`
```sql
id, nama_kecamatan, latitude, longitude, created_at, updated_at
```

### Tabel: `subsektor`
```sql
id, nama_subsektor, icon, color_code, created_at, updated_at
```

### Tabel: `articles`
```sql
id, judul, slug, konten, featured_image, kategori, 
status, published_at, views, created_at, updated_at
```

### Tabel: `banners`
```sql
id, judul, subtitle, image_desktop, image_mobile, 
button_text, button_link, order, is_active, created_at, updated_at
```

### Tabel: `settings`
```sql
id, key, value, created_at, updated_at
```

***

## 10. Development Phases

### **Phase 1 - MVP (8-10 Minggu)**

**Week 1-2: Setup & Database**
- Setup Laravel 12 + FilamentPHP 3.3 [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Database migration & seeder
- Import data dari Excel (120+ UMKM) [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Setup Tailwind CSS

**Week 3-4: Frontend Public**
- Homepage (hero, search, featured UMKM)
- Katalog UMKM (grid, filter, sort)
- Detail UMKM (info lengkap, WhatsApp button) [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)
- Detail Produk

**Week 5-6: Leaflet JS Integration** [learnlaravel](https://learnlaravel.net/1253/adding-interactive-maps-to-laravel-with-leaflet-js-step-2-installing-leaflet-with-laravel-mix/)
- Setup Leaflet JS di Laravel
- Implement base map + markers
- Custom icon per kategori
- Popup dengan info UMKM
- Filter peta interaktif
- Marker clustering [youtube](https://www.youtube.com/watch?v=LxenV0YaX8M)

**Week 7-8: Admin Panel (Filament)**
- Dashboard dengan widgets
- CRUD UMKM (dengan map picker)
- CRUD Produk
- Banner management
- Settings page

**Week 9-10: Testing & Deployment**
- UAT (User Acceptance Testing)
- Bug fixing
- Performance optimization
- Deploy ke production server
- Training untuk Super Admin

**Deliverables:**
- ✅ Katalog UMKM & Produk dengan search & filter
- ✅ Peta interaktif Leaflet JS dengan 120+ markers
- ✅ WhatsApp Click-to-Chat integration
- ✅ Admin panel lengkap (FilamentPHP)
- ✅ Responsive design
- ✅ Import data Excel

***

### **Phase 2 - Enhancement (Optional - 4-6 Minggu)**

**Week 11-12:**
- Blog/Artikel CMS
- Share social media
- Google Analytics integration
- Advanced filter (multi-select)

**Week 13-14:**
- SEO optimization (meta tags, sitemap)
- PWA features (offline mode)
- Image lazy loading optimization
- Caching strategy (Redis)

**Week 15-16:**
- Review/rating system (simple - tanpa login)
- Wishlist/favorite UMKM
- Newsletter subscription
- Notifikasi email untuk admin (UMKM baru)

**Deliverables:**
- ✅ Blog system
- ✅ Advanced analytics
- ✅ Performance optimization
- ✅ SEO enhancements

***

## 11. Success Metrics (KPI)

### Business Metrics:
- **Adoption Rate**: 90% UMKM data terinput dalam 3 bulan [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- **Traffic**: 500+ unique visitors per bulan di bulan ke-3
- **Engagement**: Average session duration > 2 menit
- **Conversion**: 100+ klik WhatsApp button per bulan
- **Coverage**: Semua 11 kecamatan terepresentasi [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

### Technical Metrics:
- **Uptime**: > 99% availability
- **Performance**: Page load < 3 detik, map render < 2 detik
- **Mobile Usage**: > 70% traffic dari mobile
- **Map Interaction**: 50+ peta interaction per hari

### Data Quality:
- **Completeness**: 80% UMKM memiliki foto & koordinat
- **Accuracy**: < 5% error rate pada nomor WhatsApp
- **Freshness**: Data update minimal 1x per 3 bulan

***

## 12. Technical Specifications

### A. Leaflet JS Configuration [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)

**Package Installation:**
```bash
npm install leaflet
npm install leaflet.markercluster  # untuk clustering
```

**Laravel Integration:**
```php
// routes/web.php
Route::get('/peta', [MapController::class, 'index'])->name('map');

// app/Http/Controllers/MapController.php
public function index() {
    $umkmLocations = UMKM::select('id', 'nama_usaha', 'jenis_subsektor', 
                                  'latitude', 'longitude', 'no_telp', 'logo')
                         ->where('status_aktif', true)
                         ->whereNotNull('latitude')
                         ->get()
                         ->map(function($umkm) {
                             return [
                                 'id' => $umkm->id,
                                 'name' => $umkm->nama_usaha,
                                 'category' => $umkm->jenis_subsektor,
                                 'lat' => (float)$umkm->latitude,
                                 'lng' => (float)$umkm->longitude,
                                 'phone' => formatPhoneNumber($umkm->no_telp),
                                 'logo' => $umkm->logo_url,
                                 'url' => route('umkm.show', $umkm->id)
                             ];
                         });
    
    return view('map', compact('umkmLocations'));
}
```

**Blade View:**
```html
<!-- resources/views/map.blade.php -->
<div id="map" style="height: 600px;"></div>

<script>
// Initialize map centered on Muna Barat
const map = L.map('map').setView([-5.15, 122.75], 11);

// Add OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18
}).addTo(map);

// Custom icons per category
const iconMapping = {
    'Fashion (Tenun)': '🧵',
    'Desain Produk': '🪑',
    'Kuliner': '🍴',
    'Kriya': '✋',
    'Seni Pertunjukan': '🎭'
};

// Add markers from Laravel data
const umkmData = @json($umkmLocations);
umkmData.forEach(umkm => {
    const marker = L.marker([umkm.lat, umkm.lng])
        .bindPopup(`
            <div class="leaflet-popup-content-wrapper">
                <img src="${umkm.logo}" alt="${umkm.name}" style="width:100%;max-height:100px;object-fit:cover;">
                <h3 class="font-bold text-lg mt-2">${umkm.name}</h3>
                <p class="text-sm text-gray-600">${umkm.category}</p>
                <div class="flex gap-2 mt-3">
                    <a href="${umkm.url}" class="btn-detail">Detail</a>
                    <a href="https://wa.me/${umkm.phone}" target="_blank" class="btn-wa">
                        <i class="fab fa-whatsapp"></i> Chat
                    </a>
                </div>
            </div>
        `)
        .addTo(map);
});
</script>
```

### B. WhatsApp Integration Format [faq.whatsapp](https://faq.whatsapp.com/5913398998672934)

**Pre-filled Message Templates:**

```php
// Helper function
function generateWhatsAppLink($phone, $umkm, $produk = null) {
    $cleanPhone = formatPhoneNumber($phone);
    
    if ($produk) {
        $message = "Halo *{$umkm->nama_usaha}*, saya tertarik dengan produk *{$produk->nama_produk}* seharga Rp" . number_format($produk->harga) . ". Apakah masih tersedia?";
    } else {
        $message = "Halo *{$umkm->nama_usaha}*, saya ingin menanyakan produk Anda yang saya lihat di website Mubar Creative Hub.";
    }
    
    return "https://wa.me/{$cleanPhone}?text=" . urlencode($message);
}
```

***

## 13. Budget Estimation

| Item | Estimasi Biaya |
|------|----------------|
| **Development MVP (8-10 minggu)** | Rp 40-60 juta |
| **Domain (.id atau .go.id)** | Rp 200rb - 500rb/tahun |
| **Hosting VPS (4GB RAM, 2 Core CPU)** | Rp 300rb - 500rb/bulan |
| **SSL Certificate** | Gratis (Let's Encrypt) |
| **OpenStreetMap (Leaflet JS)** | Gratis  [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022) |
| **Maintenance (Year 1)** | Rp 5-10 juta/tahun |
| **Training & Documentation** | Rp 3-5 juta |
| **Contingency (15%)** | Rp 7-12 juta |
| **Total Year 1** | **Rp 58-91 juta** |

***

## 14. Risks & Mitigation

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| Data koordinat UMKM tidak lengkap | Medium | High | Admin input manual via map picker, atau geocoding address  [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx) |
| Nomor WhatsApp tidak valid/berubah | High | Medium | Validation pattern, reminder update kontak per 6 bulan  [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx) |
| Performance issue dengan 120+ markers | Medium | Low | Implement marker clustering  [youtube](https://www.youtube.com/watch?v=LxenV0YaX8M) |
| UMKM tidak merespon WhatsApp inquiry | High | Medium | Tutorial untuk UMKM, display response time rating |
| OpenStreetMap tile load slow | Low | Low | Fallback tile provider, implement caching  [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022) |

***

## 15. Timeline Gantt Chart

| Week | Activities | Deliverable |
|------|-----------|-------------|
| 1-2 | Setup Laravel + Filament, Database design, Import Excel data | Development environment ready |
| 3-4 | Frontend public pages (Home, Katalog, Detail) | Public pages 70% |
| 5-6 | Leaflet JS integration + WhatsApp buttons | Interactive map functional |
| 7-8 | FilamentPHP admin panel (CRUD UMKM & Produk) | Admin panel complete |
| 9 | Testing, bug fixing, performance optimization | Beta version |
| 10 | Deployment, training, soft launch | Production live |

***

## 16. Appendix

### A. Data Structure dari Excel [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- Total UMKM: 120+
- Kecamatan: Tiworo Tengah, Tiworo Selatan, Sawerigadi, Wadaga, Maginti, Barangka, Lawa, Kusambi, Napano Kusambi, Tiworo Utara, Tiworo Kepulauan
- Subsektor: Fashion (Tenun), Desain Produk, Kuliner, Kriya, Seni Pertunjukan, Desain Interior, Fotografi, Musik, Penerbitan, Seni Rupa

### B. Required Assets
- Logo Pemda Muna Barat
- Icon per subsektor (custom design)
- Placeholder image untuk UMKM tanpa foto
- Loading animation untuk map

### C. External Dependencies
- Leaflet JS v1.9+ [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
- Leaflet MarkerCluster plugin [youtube](https://www.youtube.com/watch?v=LxenV0YaX8M)
- OpenStreetMap tile server [ultimateakash](https://www.ultimateakash.com/blog-details/Ii1TJGAKYAo=/How-To-Integrate-Leaflet-Maps-in-Laravel-2022)
- WhatsApp Business API [gptbots](https://www.gptbots.ai/blog/whatspp-click-to-chat)
- Laravel 12 [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)
- FilamentPHP 3.3+ [ppl-ai-file-upload.s3.amazonaws](https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/74613787/cc65ddbf-1266-432a-85d4-835cb421b34e/Rekapitulasi-Pendataan-Baru-4-Copy.xlsx)

***

## 17. Approval & Sign-off

| Role | Nama | Jabatan | Tanggal | TTD |
|------|------|---------|---------|-----|
| **Project Owner** |  | Kepala Dinas Pariwisata |  |  |
| **Technical Lead** |  | Developer |  |  |
| **Budget Approver** |  | Sekretaris Daerah |  |  |

***

**Catatan Revisi:**
- ✅ Role disederhanakan: hanya Super Admin
- ✅ Destinasi wisata dihapus (fokus UMKM)
- ✅ E-commerce dihapus (transaksi via WhatsApp)
- ✅ Peta menggunakan Leaflet JS (open source)
- ✅ Integrasi WhatsApp Click-to-Chat

**Dokumen ini final dan siap untuk development.*
