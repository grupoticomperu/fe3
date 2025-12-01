<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    //relacion uno a uno (un local pertenece a un usuario, el user_id foraneo esta en local)
    /*     public function user()
    {
       return $this->belongsTo(User::class);
    } */



    //relacion de muchos a muchos
    //pongo esto local_tipocomprobantes porque genere mi tabla terminado en s, debi generar local_tipocomprobante
    public function tipocomprobantes()
    {
        return $this->belongsToMany(Tipocomprobante::class, 'local_tipocomprobantes', 'local_id', 'tipocomprobante_id')->withPivot('default', 'serie', 'inicio', 'company_id');
    }

    //relacion de muchos a muchos
    public function productatributes()
    {
        return $this->belongsToMany(Productatribute::class)->withTimestamps()->withPivot('stock', 'stockmin', 'pricesale', 'pricewholesale', 'pricesalemin');
    }

    //Relacion uno a muchos
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Relación de uno a muchos inversa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relación de uno a muchos inversa
    public function local_tipocomprobantes()
    {
        return $this->belongsTo(Local_tipocomprobante::class);
    }
}
