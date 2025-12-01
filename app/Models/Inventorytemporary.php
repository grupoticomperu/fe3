<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventorytemporary extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'name', 'stocksistema', 'stockcontado', 'diferencia', 'inventory_id', 'local_id',  'local_productatribute_id'];
}
