<?php

namespace App\Imports;

use App\Models\UMKM;
use App\Models\Subsektor;
use App\Models\Kecamatan;
use App\Models\Desa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UMKMImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Find or create subsektor
        $subsektor = Subsektor::firstOrCreate(
            ['nama_subsektor' => $row['subsektor']],
            ['nama_subsektor' => $row['subsektor']]
        );

        // Find kecamatan by name
        $kecamatan = Kecamatan::where('nama_kecamatan', $row['kecamatan'])->first();

        // Find or create desa based on kecamatan
        $desa = null;
        if ($kecamatan) {
            $desa = Desa::firstOrCreate(
                [
                    'nama_desa' => $row['desa'],
                    'kecamatan_id' => $kecamatan->id
                ],
                [
                    'nama_desa' => $row['desa'],
                    'kecamatan_id' => $kecamatan->id
                ]
            );
        }

        return new UMKM([
            'nama_usaha' => $row['nama_usaha'],
            'nama_pemilik' => $row['nama_pemilik'],
            'subsektor_id' => $subsektor->id,
            'jenis_badan_usaha' => $row['jenis_badan_usaha'] ?? null,
            'tahun_berdiri' => $row['tahun_berdiri'],
            'alamat_usaha' => $row['alamat_usaha'],
            'kecamatan_id' => $kecamatan?->id,
            'desa_id' => $desa?->id,
            'jumlah_tenaga_kerja' => $row['jumlah_tenaga_kerja'] ?? 0,
            'omset_tahun' => $row['omset_tahun'] ?? 0,
            'no_telp' => !empty($row['no_telp']) ? $row['no_telp'] : null,
            'email' => $row['email'] ?? null,
            'jenis_hki' => $row['jenis_hki'] ?? null,
            'nib' => $row['nib'] ?? null,
            'facebook' => $row['facebook'] ?? null,
            'instagram' => $row['instagram'] ?? null,
            'tiktok' => $row['tiktok'] ?? null,
            'whatsapp' => $row['whatsapp'] ?? null,
            'website' => $row['website'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'longitude' => $row['longitude'] ?? null,
            'deskripsi' => $row['deskripsi'] ?? null,
            'status_aktif' => $this->mapBooleanValue($row['status_aktif'] ?? true),
            'status_verifikasi' => $this->mapBooleanValue($row['status_verifikasi'] ?? false),
        ]);
    }

    private function mapBooleanValue($value)
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            $value = strtolower(trim($value));
            return $value === '1' || $value === 'yes' || $value === 'true' || $value === 'aktif' || $value === 'verifikasi';
        }

        return (bool) $value;
    }

    public function rules(): array
    {
        return [
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'subsektor' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'alamat_usaha' => 'required|string',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
        ];
    }
}