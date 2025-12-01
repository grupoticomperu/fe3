<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    //relacin de uno a muchos inversa  un distrito pertenece a una provincia
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    //relacin de uno a muchos inversa  un distrito pertenece a un departamento
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
