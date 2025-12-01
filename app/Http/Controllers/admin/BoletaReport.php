<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class BoletaReport extends Controller
{
    public function generarPDF()
    {
        // Datos para pasar a la vista
        $datos = [
            'nombreEmpresa' => 'Nombre de tu empresa',
            'fecha' => now(),
            // Otros datos necesarios para el comprobante
        ];

        // Renderizar la vista en HTML
        ///$html = view('admin/comprobante/boletareports', $datos)->render();

        // Configurar Dompdf
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml($html);
        //$dompdf->setPaper('7.5cm', 'auto'); // Establecer el ancho a 8cm
        $pdf = PDF::setPaper([0, 0, 800, 280], 'landscape')->loadView('admin.comprobante.boletareports');
        return $pdf->stream('comprobante.pdf');
        //$dompdf->render();

        // Descargar el PDF
        //return $dompdf->stream('comprobante.pdf');
    }
}
