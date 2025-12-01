<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];


        //Relacion uno a muchos
        public function guias(){
            return $this->hasMany(Guia::class);
        }

        public function tipodocumento(){
            return $this->belongsTo(Tipodocumento::class);
        }

}
