<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagegeneral extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'imagegeneralable_id', 'imagegeneralable_type'];

    public function imagegeneralable(){
        return $this->morphTo();
    }
}
