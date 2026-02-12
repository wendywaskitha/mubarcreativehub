# Panduan Import Excel UMKM

## Deskripsi
Fitur ini memungkinkan Anda untuk mengimpor data UMKM secara massal menggunakan file Excel (.xlsx, .xls) atau CSV.

## Template Import
Template yang digunakan harus mengikuti format berikut:

| Kolom | Tipe Data | Deskripsi |
|-------|-----------|-----------|
| Nama Usaha | String | Nama dari usaha UMKM (wajib) |
| Nama Pemilik | String | Nama pemilik atau pengelola usaha (wajib) |
| Subsektor | String | Subsektor ekonomi kreatif (wajib) |
| Jenis Badan Usaha | String | Jenis badan usaha (Perseorangan, CV, UD, dll) |
| Tahun Berdiri | Integer | Tahun usaha berdiri (1900-sekarang) |
| Jumlah Tenaga Kerja | Integer | Jumlah tenaga kerja (angka positif) |
| Omset per Tahun | Integer | Omset tahunan dalam rupiah (angka positif) |
| Nomor Telepon | String | Nomor telepon dalam format internasional (contoh: 6281234567890) |
| Email | String | Alamat email usaha |
| Kecamatan | String | Nama kecamatan (wajib) |
| Desa | String | Nama desa/kelurahan (wajib) |
| Alamat Usaha | String | Alamat lengkap usaha |
| WhatsApp | String | Link WhatsApp Business |
| Instagram | String | Username atau URL Instagram |
| Facebook | String | URL halaman Facebook |
| TikTok | String | Username atau URL TikTok |
| Website | String | URL website atau e-commerce |
| NIB | String | Nomor Induk Berusaha dari OSS |
| Jenis HKI | String | Jenis Hak Kekayaan Intelektual |
| Deskripsi | String | Deskripsi usaha (maks 1000 karakter) |
| Status Aktif | Boolean | Status aktif usaha (1 untuk aktif, 0 untuk tidak aktif) |
| Status Verifikasi | Boolean | Status verifikasi data (1 untuk terverifikasi, 0 untuk belum) |

## Cara Menggunakan
1. Unduh template dari [path_template] (akan ditambahkan nanti)
2. Isi data UMKM sesuai dengan format yang telah ditentukan
3. Simpan file dalam format Excel (.xlsx, .xls) atau CSV
4. Di halaman manajemen UMKM, klik tombol "Import"
5. Pilih file yang telah Anda siapkan
6. Sesuaikan mapping kolom jika diperlukan
7. Klik "Import" untuk memulai proses

## Catatan Penting
- Kolom yang wajib diisi ditandai dengan (wajib) di atas
- Jika nama usaha sudah ada di database, sistem akan mengabaikan duplikat atau memperbarui data yang ada
- Pastikan format nomor telepon menggunakan format internasional tanpa tanda +
- Format email harus valid
- Format website harus berupa URL lengkap (dimulai dengan http:// atau https://)
- Untuk kolom boolean, gunakan 1 untuk true/aktif dan 0 untuk false/nonaktif
- Pastikan nama kecamatan dan desa sesuai dengan data yang ada di sistem

## Contoh Data
Berikut adalah contoh data yang benar:

| Nama Usaha | Nama Pemilik | Subsektor | Jenis Badan Usaha | Tahun Berdiri | Jumlah Tenaga Kerja | Omset per Tahun | Nomor Telepon | Email | Kecamatan | Desa | Alamat Usaha | Status Aktif | Status Verifikasi |
|------------|--------------|-----------|-------------------|---------------|---------------------|-----------------|---------------|-------|-----------|------|--------------|--------------|-------------------|
| Batik Nusantara | Budi Santoso | Kriya | UD | 2020 | 5 | 50000000 | 6281234567890 | budi@batiknusantara.com | Kota Raha | Baruga | Jl. Batik No. 123 | 1 | 0 |

## Kesalahan Umum
- Format tanggal salah (tidak digunakan dalam template ini)
- Format angka salah (gunakan angka tanpa simbol seperti titik atau koma untuk ribuan)
- Kolom wajib dikosongkan
- Format email tidak valid
- Format telepon tidak sesuai standar internasional