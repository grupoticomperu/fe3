<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        //$bussiness = User::orderBy('id', 'desc')->take(12)->get();
       // $bussiness = User::where('state', 1)->take(12)->get();
        //$productos = Product::where('state', 1)->orderBy('id', 'desc')->take(12)->get();

    //dd($bussiness);
        //return view('welcome', compact('bussiness', 'productos'));
        return view('welcome');
    }
}
