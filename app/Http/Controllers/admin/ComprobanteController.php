<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ComprobanteController extends Controller
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
        return view('admin.comprobante.create');
    }

    public function createdos()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.comprobante.createdos');
    }

    public function createtres()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.comprobante.createtres');
    }


    public function createcuatro()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.comprobante.createcuatro');
    }


    public function createcinco()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.comprobante.createcinco');
    }

    public function createrapido()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.comprobante.createrapido');
    }


}
