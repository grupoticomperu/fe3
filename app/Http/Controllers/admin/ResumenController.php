<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResumenController extends Controller
{
    //
    public function create()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.resumens.create');
    }

    public function createe()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.resumens.createe');
    }
}
