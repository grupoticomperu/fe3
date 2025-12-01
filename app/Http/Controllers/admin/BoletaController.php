<?php

namespace App\Http\Controllers\admin;

use App\Models\Boleta;
use App\Models\Resumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoletaController extends Controller
{
    public function index(Resumen $resumen)
    {
        $boletas = Boleta::where('resumen_id', $resumen->id)->paginate(2);
        //return response()->json($boletas);

        return view('admin.boletas.index', compact('boletas', 'resumen'));
        //return response()->json($boletas);
    }
}
