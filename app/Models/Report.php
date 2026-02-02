<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Report model serves as a virtual model for reporting purposes
 * It doesn't correspond to a physical table but is used for Filament reporting
 */
class Report extends Model
{
    // This model doesn't have a corresponding table
    public $timestamps = false;

    // Make the model "read-only" for reporting purposes
    protected $guarded = ['*'];
}
