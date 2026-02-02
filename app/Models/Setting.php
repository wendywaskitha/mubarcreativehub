<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Get a setting value by key
     */
    public static function getValue(string $key, string $default = '')
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key
     */
    public static function setValue(string $key, string $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Delete a setting and remove associated file if it's a file setting
     */
    public static function deleteKey(string $key): void
    {
        $setting = self::where('key', $key)->first();

        if ($setting) {
            // If this is a file setting, delete the associated file
            if (in_array($key, ['site_logo', 'frontend_logo', 'site_favicon']) && !empty($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            $setting->delete();
        }
    }
}
