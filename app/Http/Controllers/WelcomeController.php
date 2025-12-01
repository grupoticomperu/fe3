<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {

/*         if (auth()->user()) {

            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();

            if ($pendiente) {

                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='" . route('orders.index') ."?status=1'>Ir a pagar</a>";

                session()->flash('flash.banner', $mensaje);
            }

        } */

       // $categories = Category::where('state', 1)->get();
        return view('welcome')->layout('layouts.app');
        //return view('welcome', compact('categories'))->layout('layouts.appwebd');
        //return view('welcomed', compact('categories'))->layout('layouts.appwebd');
        //return view('welcomet', compact('categories'))->layout('layouts.appwebt');

    }
}
