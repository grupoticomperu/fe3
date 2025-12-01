<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'state'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str::slug($name);
    }



}
