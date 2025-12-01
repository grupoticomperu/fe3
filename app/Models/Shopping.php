<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['fechaemision','fechavencimiento'];

    //relacion uno a muchos polimorfica
    public function imagegenerals()
    {
        return $this->morphMany(Imagegeneral::class, "imagegeneralable");
    }


    //Relacion uno a muhos inversa
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    //Relacion uno a muhos inversa
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }





}
