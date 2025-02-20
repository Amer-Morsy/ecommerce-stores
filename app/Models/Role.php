<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['name', 'permission'];

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }

    public function users()
    {
        $this->hasMany(Admin::class);
    }
}
