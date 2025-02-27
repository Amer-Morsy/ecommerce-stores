<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];

    public $translatedAttributes = ['name'];

    protected $fillable = ['slug'];

    protected $hidden = ['translations'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags');
    }
}
