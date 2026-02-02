<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UMKM extends Model
{
    protected $table = 'umkms';

    protected $fillable = [
        'nama_usaha',
        'nama_pemilik',
        'subsektor_id',
        'alamat_usaha',
        'kecamatan_id',
        'desa_id',
        'tahun_berdiri',
        'jumlah_tenaga_kerja',
        'omset_tahun',
        'no_telp',
        'email',
        'jenis_badan_usaha',
        'jenis_hki',
        'nib',
        'facebook',
        'instagram',
        'tiktok',
        'whatsapp',
        'website',
        'logo',
        'deskripsi',
        'status_aktif',
        'status_verifikasi',
        'views'
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'status_verifikasi' => 'boolean',
        'views' => 'integer',
        'tahun_berdiri' => 'integer',
        'jumlah_tenaga_kerja' => 'integer',
        'omset_tahun' => 'integer'
    ];

    public function subsektor(): BelongsTo
    {
        return $this->belongsTo(Subsektor::class, 'subsektor_id');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'umkm_id');
    }

    /**
     * Get the verification status label
     */
    public function getVerificationStatusLabelAttribute(): string
    {
        return $this->status_verifikasi ? 'Terverifikasi' : 'Belum Terverifikasi';
    }

    /**
     * Get the verification status badge class
     */
    public function getVerificationStatusBadgeClassAttribute(): string
    {
        return $this->status_verifikasi ? 'bg-success' : 'bg-warning';
    }
}
