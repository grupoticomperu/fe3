<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initialinventory_productatribute extends Model
{
    use HasFactory;
    protected $table = "initialinventory_productatribute";
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion uno a muhos inversa
    public function productatribute(){
        return $this->belongsTo(Productatribute::class);
    }

    public function initialinventory(){
        return $this->belongsTo(Initialinventory::class);
    }



}
