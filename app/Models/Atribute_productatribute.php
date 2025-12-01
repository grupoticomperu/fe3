<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribute_productatribute extends Model
{
    use HasFactory;
    protected $table = "atribute_productatribute";
    protected $guarded = ['id', 'created_at', 'updated_at'];


    //de uno a muchos inversa
    public function productatribute()
    {
        return $this->belongsTo(Productatribute::class);
    }

    //de uno a muchos inversa
    public function atribute()
    {
        return $this->belongsTo(Atribute::class);
    }
}
