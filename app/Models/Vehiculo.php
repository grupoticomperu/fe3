<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relacion de muchos a muchos
    public function guias()
    {
        return $this->belongsToMany(Guia::class);
    }

    //relacion de uno a muchos inversa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
