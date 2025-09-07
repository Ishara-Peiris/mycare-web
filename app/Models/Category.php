<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

class Category extends Model
{
     protected $fillable = ['name'];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
