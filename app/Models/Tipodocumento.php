<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    use HasFactory;

    //Relacion muchos a muchos
    /* public function customers()
    {
        return $this->belongsToMany(Customer::class);
    } */

    //Relacion uno a muchos
    public function customers(){
        return $this->hasMany(Customer::class);
    }

    //Relacion uno a muchos
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }

        //Relacion uno a muchos
        public function transportistas(){
            return $this->hasMany(Transportista::class);
        }

}
