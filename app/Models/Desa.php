<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    protected $table = 'desas';

    protected $fillable = [
        'nama_desa',
        'kecamatan_id'
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function umkms(): HasMany
    {
        return $this->hasMany(UMKM::class, 'desa_id');
    }
}
