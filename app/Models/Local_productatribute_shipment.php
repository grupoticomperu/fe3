<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Local_productatribute_shipment extends Model
{
    use HasFactory;


    protected $fillable = ['shipment_id', 'local_productatribute_id', 'quantity'];

    // Relación con el shipment
    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    // Relación con el producto osea con local_productatribute
    public function localproductatribute()
    {
        return $this->belongsTo(Localproductatribute::class, 'local_productatribute_id');
    }

}
