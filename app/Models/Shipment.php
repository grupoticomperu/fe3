<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['name','fechaenvio','fechaaceptacion','local_envia_id', 'local_recibe_id', 'state', 'total','nota','user_id','user_recibe_id'];

    // Relación con el local que envía el envío
    public function localEnvia()
    {
        return $this->belongsTo(Local::class, 'local_envia_id');
    }

    // Relación con el local que recibe el envío
    public function localRecibe()
    {
        return $this->belongsTo(Local::class, 'local_recibe_id');
    }


    // Relación con el usuario que recepciona
     public function userAcepta()
    {
        return $this->belongsTo(User::class, 'userqueacepta_id');
    }

    // Relación con el usuario que solicito el envio o el usuario a quien se notifico
    public function userRecibe()
    {
        return $this->belongsTo(User::class, 'user_recibe_id');
    }


    // Relación con los detalles de envío
    public function detalleEnvios()
    {
        return $this->hasMany(Local_productatribute_shipment::class, 'shipment_id');
    }
}
