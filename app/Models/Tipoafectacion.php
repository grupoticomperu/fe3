<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoafectacion extends Model
{
    use HasFactory;
    //relacion de uno a muchos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
