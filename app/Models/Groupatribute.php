<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupatribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'state','order'
    ];

    //de uno a muchos
    public function atributes()
    {
        return $this->hasMany(Atribute::class);  
    }



}
