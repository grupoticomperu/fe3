<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function showtables(){
       
        return view('admin.tablesshow');
    }
}
