<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\UMKM;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProdukImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Find UMKM by name
            $umkm = UMKM::where('nama_usaha', $row['umkm'])->first();

            if (!$umkm) {
                // Skip if UMKM doesn't exist
                continue;
            }

            // Create or update Produk
            Produk::updateOrCreate(
                [
                    'nama_produk' => $row['nama_produk'],
                    'umkm_id' => $umkm->id
                ],
                [
                    'slug' => $row['slug'] ?? \Illuminate\Support\Str::slug($row['nama_produk']),
                    'kategori' => $row['kategori'] ?? null,
                    'deskripsi' => $row['deskripsi'] ?? null,
                    'status_tersedia' => $row['status_tersedia'] ?? true,
                    'is_featured' => $row['is_featured'] ?? false,
                    'tags' => $row['tags'] ?? null,
                    'foto_1' => $row['foto_1'] ?? null,
                    'foto_2' => $row['foto_2'] ?? null,
                    'foto_3' => $row['foto_3'] ?? null,
                    'foto_4' => $row['foto_4'] ?? null,
                    'foto_5' => $row['foto_5'] ?? null,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:255',
            'umkm' => 'required|string|exists:umkms,nama_usaha',
            'slug' => 'nullable|string|max:255|unique:produks,slug',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status_tersedia' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|string',
            'foto_1' => 'nullable|url',
            'foto_2' => 'nullable|url',
            'foto_3' => 'nullable|url',
            'foto_4' => 'nullable|url',
            'foto_5' => 'nullable|url',
        ];
    }
}