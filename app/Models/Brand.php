<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Translatable;

    // Load translations automatically
    protected $with = ['translations'];

    // Translatable attributes
    public $translatedAttributes = ['name'];

    // Fillable attributes
    protected $fillable = [
        'is_active',
        'photo',
    ];

    // Hidden attributes
    protected $hidden = [
        'translations',
    ];

    // Attribute casting
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Active Brands
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Get Active Status Text
     */
    public function getActive()
    {
        return $this->is_active ? __('general.active') : __('general.not_active');
    }

    /**
     * Accessor: Photo URL
     */
//    public function photo()
//    {
//        return Attribute::get(function ($value) {
//            return $value ? asset('assets/images/brands/' . $value) : '';
//        });
//    }
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }
}
