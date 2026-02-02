<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subsektor extends Model
{
    protected $table = 'subsektors';

    protected $fillable = [
        'nama_subsektor',
        'icon',
        'color_code'
    ];

    public function umkms(): HasMany
    {
        return $this->hasMany(UMKM::class, 'subsektor_id');
    }

    /**
     * Alias for umkms relationship - represents creative economy actors
     */
    public function pelaku(): HasMany
    {
        return $this->hasMany(UMKM::class, 'subsektor_id');
    }

}
