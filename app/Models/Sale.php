<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion uno a muhos inversa
    public function localtipocomprobante()
    {
        return $this->belongsTo(Local_tipocomprobante::class, 'local_tipocomprobante_id');
    }


    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function tipocomprobante()
    {
        return $this->belongsTo(Tipocomprobante::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function paymenttype()
    {
        return $this->belongsTo(Paymenttype::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos
    public function boletas(){
        return $this->hasMany(Boleta::class);
    }

}
