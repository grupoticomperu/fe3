<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Um extends Model
{
    use HasFactory;
    //relacion de uno a muchos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function guias()
    {
        return $this->hasMany(Guia::class);
    }

}
