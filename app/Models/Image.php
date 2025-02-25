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
    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";
    }
}
