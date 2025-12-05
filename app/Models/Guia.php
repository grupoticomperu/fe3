<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];


    //uno a muchos inversa

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }



    public function motivotraslado()
    {
        return $this->belongsTo(Motivotraslado::class);
    }

    public function um()
    {
        return $this->belongsTo(Um::class);
    }

    public function puntodepartida()
    {
        return $this->belongsTo(Puntodepartida::class);
    }

    public function transportista()
    {
        return $this->belongsTo(Transportista::class);
    }

    //relacion de muchos a muchos
    public function vehiculos()
    {
        return $this->belongsToMany(Vehiculo::class);
    }

    public function conductors()
    {
        return $this->belongsToMany(Conductor::class);
    }

    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class);
    }
}
