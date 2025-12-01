<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productatribute_shopping extends Model
{
    use HasFactory;

    protected $table = "productatribute_shoppings";
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion uno a muhos inversa
    public function productatribute(){
        return $this->belongsTo(Productatribute::class);
    }

    public function shopping(){
        return $this->belongsTo(Shopping::class);
    }


}
