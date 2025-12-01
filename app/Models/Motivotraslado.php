<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivotraslado extends Model
{
    use HasFactory;

    //relacion de uno a muchos
    public function guias()
    {
        return $this->hasMany(Guia::class);
    }


}
