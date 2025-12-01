<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion uno a muchos
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    //Relacion uno a muchos
    public function locals()
    {
        return $this->hasMany(Local::class);
    }

    //relacion de uno a muchos inversa
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    //relacion de uno a muchos inversa
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    //relacion de uno a muchos inversa
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    //relacion de uno a muchos inversa
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
