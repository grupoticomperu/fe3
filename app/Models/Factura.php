<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //uno a muchos inversa
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    //uno a muchos inversa
    public function paymentype()
    {
        return $this->belongsTo(Paymenttype::class, 'paymentype_id');
    }

    //de uno a muchos inversa
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }


    //relacion de uno a muchos polimorfica, con boleta, lo mismo en factura
    /*   public function comprobantes()
 {
     return $this->morphMany('App\Models\Comprobante','comprobanteable');
 } */

    public function pymenttypes()
    {
        return $this->hasMany(Paymenttype::class);
    }

    /*relcion de uno a uno*/
    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class);
    }
}
