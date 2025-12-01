<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const MASCULINO = 1;
    const FEMENINO = 2;

    //Relacion uno a uno
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación de uno a muchos inversa
    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    // Relación de uno a muchos inversa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
