<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    const AWS = 1;
    const LOCAL = 2;
    const STORAGE = 3;


}
