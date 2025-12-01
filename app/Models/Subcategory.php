<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];



    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str::slug($name);

    }

    //URL AMIGABLES
    public function getRouteKeyName()
    {
        return 'slug';
    }



    //Relacion uno a muchos
    public function productfamilies(){
        return $this->hasMany(Productfamilie::class);
    }

    //Relacion uno a muhos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }


}
