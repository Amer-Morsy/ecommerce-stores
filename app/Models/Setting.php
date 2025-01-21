<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Setting extends Model
{
    use HasFactory, Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['value'];

    protected $fillable = ['key', 'is_translatable', 'plain_value'];

    protected $casts = [
        'is_translatable' => 'boolean',
    ];

    public static function setMany(array $settings)
    {
        DB::transaction(function () use ($settings) {
            foreach ($settings as $key => $value) {
                try {
                    self::set($key, $value);
                } catch (\Exception $e) {
                    Log::error("Failed to set setting for key: {$key}", [
                        'value' => $value,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        });
    }

    public static function set( $key, $value)
    {
        // Handle special translatable settings case
        if ($key === 'translatable') {
            static::setTranslatableSettings($value);
            return;
        }

        // Normalize value to string if it's an array
        $plainValue = is_array($value) ? json_encode($value) : $value;

        static::updateOrCreate(
            ['key' => $key],
            ['plain_value' => $plainValue]
        );
    }

    public static function setTranslatableSettings(array $settings)
    {
        DB::transaction(function () use ($settings) {
            foreach ($settings as $key => $value) {
                try {
                    static::updateOrCreate(
                        ['key' => $key],
                        [
                            'is_translatable' => true,
                            'value' => $value,
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error("Failed to set translatable setting for key: {$key}", [
                        'value' => $value,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        });
    }
}
