<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relación de uno a muchos
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class);
    }

    public function guias()
    {
        return $this->hasMany(Guia::class);
    }


    //relacion de uno a muchos inversa
    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class);
    }

    //relacion de uno a muchos inversa
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    //relacion de uno a muchos inversa
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    //relacion de uno a muchos inversa
    public function district()
    {
        return $this->belongsTo(District::class);
    }


}
