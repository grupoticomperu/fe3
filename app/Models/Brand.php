<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'state', 'order', 'company_id', 'image', 'title', 'description','keywords' ,'created_at', 'updated_at'
    ];


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str::slug($name);
    }


    //Relacion uno a muchos
    public function productfamilies(){
        return $this->hasMany(Productfamilie::class);
    }

    //Relacion muchos a muchos
     public function categories(){
        return $this->belongsToMany(Category::class);
    }




}
