<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'featured_image',
        'kategori',
        'status',
        'published_at',
        'views',
        'user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
        'status' => 'string'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
