<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function index()
    {
        return view('admin.shipments.index');
    }


    public function create()
    {
        return view('admin.shipments.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Shipment $shipment)
    {
        //
    }


    public function edit(Shipment $shipment)
    {
        //
    }



    public function update(Request $request, Shipment $shipment)
    {
        //
    }


    public function destroy(Shipment $shipment)
    {
        //
    }
}
