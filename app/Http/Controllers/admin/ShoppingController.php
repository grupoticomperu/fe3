<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Currency;
use App\Models\Shopping;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\Imagegeneral;
use Illuminate\Http\Request;
use App\Models\Tipocomprobante;
use App\Http\Controllers\Controller;

class ShoppingController extends Controller
{

    public function index()
    {
        return view('admin.shoppings.index');
    }


    public function create()
    {
        //$suppliers = Supplier::all();
        //$currencies = Currency::all();
        //$tipocomprobantes = Tipocomprobante::all();
        return view('admin.shoppings.create');
    }



    public function store(Request $request)
    {
        $request->validate([
    		'fechaemision' => 'required',
            'supplier_id' => 'required',
            'serienumero'=>'required',
            'subtotal' => 'numeric',
            'igv'=>'numeric',
            'total' => 'numeric',
            'tipocomprobante_id' =>'required',
            'supplier_id' => 'required',
            'currency_id' => 'required',

    	]);

        // $shopping = (new Shopping())->fill($request->all());

        $shopping = Shopping::create([
            'supplier_id' => $request->supplier_id,
            'fechaemision' => $request->has('fechaemision') ? Carbon::parse($request->get('fechaemision')) : null,
            'fechavencimiento' => $request->has('fechavencimiento') ? Carbon::parse($request->get('fechavencimiento')) : null,
            'serienumero' => Str::upper($request->serienumero),
            'formadepago' => $request->formadepago,
            'subtotal' => $request->subtotal,
            'igv' => $request->igv,
            'total' => $request->total,
            'tipocomprobante_id' => $request->tipocomprobante_id,
            'currency_id' => $request->currency_id,
        ]);


        /*  $shopping = Shopping::create([
            'fechaemision' => $request->fechaemision,
            'supplier_id' => $request->supplier_id,
            'serienumero'=> $request->serienumero,
            'subtotal' => $request->subtotal,
            'igv'=> $request->igv,
            'total' => $request->total,
            'tipocomprobante_id' => $request->tipocomprobante_id,
            'supplier_id' => $request->supplier_id,
            'currency_id' => $request->sericurrency_id,
        ]); */


         if($request->hasFile('photo'))
        {
            Imagegeneral::create([
            'url' => request()->file('photo')->store('shoppings'),
            'imageable_id' => $shopping->id,
            'imageable_type' => Shopping::class
            ]);
            //$shopping->image = request()->file('image')->store('parallaxes');
        }

        //$shopping->save();
        return redirect()->route('admin.shopping.index')->with('flash', 'Compra creado con exito');
    }


    public function show(Shopping $shopping)
    {
        //
    }


    public function edit(Shopping $shopping)
    {
        //
    }


    public function update(Request $request, Shopping $shopping)
    {
        //
    }


    public function destroy(Shopping $shopping)
    {
        //
    }
}
