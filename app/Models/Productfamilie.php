<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Str;

class Productfamilie extends Model
{
    use HasFactory;

    const PRODUCTOTERMINADO = 1;
    const MERCADERIA = 2;
    const SERVICIO = 3;



    //URL AMIGABLES
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'name', 'description', 'state','order','simplecompuesto','tienenumerodeserie','genero', 'category_id','modelo_id','brand_id'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str::slug($name);
    }

    //de uno a muchos
    public function productatributes()
    {
        return $this->hasMany(Productatribute::class);
    }

    //Relacion uno a muhos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
