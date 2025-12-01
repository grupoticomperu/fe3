<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const ENPROCESO = 1;
    const TERMINADO = 2;

    //relacion de muchos a muchos
    public function localproductatributes()
    {
        return $this->belongsToMany(Localproductatribute::class)->withTimestamps()->withPivot('stock');
    }

    //Relacion uno a muhos inversa
    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
