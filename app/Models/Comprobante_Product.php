<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante_Product extends Model
{
    use HasFactory;
    protected $table = "comprobante_producto";

    protected $guarded = ['id', 'created_at', 'updated_at'];


    //de uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class, 'comprobante_id');
    }


}
