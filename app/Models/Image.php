<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['product_id', 'photo', 'created_at', 'updated_at'];

    /**
     * Accessor: Photo URL
     */
    protected function photo()
    {
        return Attribute::get(function ($value) {
            return $value ? asset('assets/images/products/' . $value) : '';
        });
    }
}
