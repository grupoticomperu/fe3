<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sales.index');
    }

    public function create()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.sales.create');
    }


}
