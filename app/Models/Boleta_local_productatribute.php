<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta_local_productatribute extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = "boleta_local_productatribute";
}
