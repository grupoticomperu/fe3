<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntodepartida extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function guias()
    {
        return $this->hasMany(Guia::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }


    public function district()
    {
        return $this->belongsTo(District::class);
    }


}
