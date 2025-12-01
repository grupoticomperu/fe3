<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Initialinventory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const NOINICIADO = 1;
    const ENPROCESO = 2;
    const TERMINADO = 3;

    //relacion de muchos a muchos
    public function productatributes(){
        return $this->belongsToMany(Productatribute::class)->withTimestamps()->withPivot('stock');
    }

}
