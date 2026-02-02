<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'slug',
        'deskripsi',
        'harga',
        'foto_1',
        'foto_2',
        'foto_3',
        'foto_4',
        'foto_5',
        'kategori',
        'tags',
        'status_tersedia',
        'is_featured',
        'views'
    ];

    protected $casts = [
        'umkm_id' => 'integer',
        'harga' => 'integer',
        'status_tersedia' => 'boolean',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'tags' => 'array' // Store tags as JSON
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(UMKM::class, 'umkm_id');
    }

    /**
     * Generate slug automatically when creating/updating a product
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama_produk) . '-' . time();
            }
        });

        static::updating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama_produk) . '-' . time();
            }
        });
    }
}
