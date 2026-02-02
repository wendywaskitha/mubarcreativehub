<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan UMKM</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0.5cm;
        }

        .kop-header {
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .kop-logo {
            width: 80px;
            height: 80px;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .kop-text h3 {
            margin: 5px 0 0 0;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .kop-text p {
            margin: 3px 0;
            font-size: 8px;
            text-align: center;
        }

        .report-title {
            text-align: center;
            margin: 15px 0 10px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .date-info {
            text-align: center;
            margin-bottom: 10px;
            font-size: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table {
            border: 1px solid #000;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 3px;
            text-align: left;
            font-size: 7px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>
    <table class="kop-header" style="width: 100%; border-collapse: collapse; border: none;">
        <tbody>
            <tr>
                <td style="vertical-align: top; width: 15%; padding: 0;">
                    <div class="kop-logo">
                        <img src="{{ public_path('storage/print-logo/Lambang_Kabupaten_Muna_Barat.png') }}"
                            alt="Logo Kabupaten Muna Barat" style="width: 100%; height: auto; object-fit: contain;">
                    </div>
                </td>
                <td style="vertical-align: top; width: 85%; padding: 0;">
                    <div class="kop-text">
                        <h3>PEMERINTAH KABUPATEN MUNA BARAT</h3>
                        <h2>DINAS PARIWISATA DAN EKONOMI KREATIF</h2>
                        <p>Jl. Poros Wapae Jaya, Kec. Tiworo Tangah, Muna Barat, Sulawesi Tenggara 93754</p>
                        <p>Website: www.munabaratkab.go.id | Email: info@munabaratkab.go.id | Telp: (0402) 1234567</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>

    <div class="report-title">
        LAPORAN DATA PELAKU EKONOMI KREATIF KABUPATEN MUNA BARAT
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Usaha</th>
                <th>Nama Pemilik</th>
                <th>Subsektor</th>
                <th>Alamat Usaha</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Tahun Berdiri</th>
                <th>Jumlah Tenaga Kerja</th>
                <th>Omset Tahunan</th>
                <th>No. Telp</th>
                <th>Email</th>
                <th>Jenis Badan Usaha</th>
                <th>Jenis HAKI</th>
                <th>NIB</th>
                <th>Status Aktif</th>
                <th>Status Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umkms as $index => $umkm)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $umkm->nama_usaha }}</td>
                    <td>{{ $umkm->nama_pemilik }}</td>
                    <td>{{ $umkm->subsektor->nama_subsektor ?? '-' }}</td>
                    <td>{{ $umkm->alamat_usaha }}</td>
                    <td>{{ $umkm->kecamatan->nama_kecamatan ?? '-' }}</td>
                    <td>{{ $umkm->desa->nama_desa ?? '-' }}</td>
                    <td>{{ $umkm->tahun_berdiri }}</td>
                    <td>{{ $umkm->jumlah_tenaga_kerja }}</td>
                    <td>{{ $umkm->omset_tahun ? 'Rp ' . number_format($umkm->omset_tahun, 0, ',', '.') : '-' }}</td>
                    <td>{{ $umkm->no_telp }}</td>
                    <td>{{ $umkm->email }}</td>
                    <td>{{ $umkm->jenis_badan_usaha ?? '-' }}</td>
                    <td>{{ $umkm->jenis_hki ?? '-' }}</td>
                    <td>{{ $umkm->nib ?? '-' }}</td>
                    <td>{{ $umkm->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>{{ $umkm->status_verifikasi ? 'Terverifikasi' : 'Belum Terverifikasi' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature Section -->
    @if (isset($signatureData) && !empty($signatureData))
        <div style="margin-top: 40px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 70%;"></td>
                    <td style="width: 30%;">
                        <p style="text-align: center; font-size: 8px;">Laworo, {{ now()->format('d F Y') }}</p>
                        <p style="text-align: center; margin: 2px 0; font-size: 8px;">Mengetahui, </p>
                        <p style="text-align: center; margin: 2px 0; font-size: 8px;">Kepala Dinas</p>
                        <p style="text-align: center; margin-top: 60px; font-weight: bold; font-size: 8px;">
                            {{ $signatureData['nama_kepala_dinas'] ?? '' }}</p>
                        <p style="text-align: center; margin: 2px 0; font-size: 8px;">{{ $signatureData['pangkat_gol'] ?? '' }}</p>
                        <p style="text-align: center; margin: 2px 0; font-size: 8px;">NIP. {{ $signatureData['nip'] ?? '' }}</p>
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>Total Data: {{ $umkms->count() }} Pelaku Ekraf | Dicetak: {{ now()->format('d M Y H:i:s') }}</p>
    </div>
</body>

</html>
