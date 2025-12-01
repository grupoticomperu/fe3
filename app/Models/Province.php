<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    //relacion deuno a muchos  una provincia tiene uno o muchos distritos
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    //relacin de uno a muchos inversa  una province pertenece a un departamento
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
