<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    protected $table = 'kecamatans';

    protected $fillable = [
        'nama_kecamatan',
        'latitude',
        'longitude'
    ];

    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }

    public function umkms(): HasMany
    {
        return $this->hasMany(UMKM::class, 'kecamatan_id');
    }
}
