<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncfactura extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //de uno a muchos inversa
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    //de uno a muchos inversa
    public function tipocomprobante()
    {
        return $this->belongsTo(Tipocomprobante::class); //para ver si es factura 01, boleta 03,
    }
    //de uno a muchos inversa
    public function tipodenotadecredito()
    {
        return $this->belongsTo(Tipodenotadecredito::class, 'tipodenotadecredito_id');
    }

    /*relcion de uno a uno*/
    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class);
    }

}
