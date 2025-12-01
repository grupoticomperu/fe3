<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class GuiaPdfController extends Controller
{
     public function print($id, $format = 'a4')
    {
        $guia = Guia::with(['customer', 'company', 'vehiculos', 'conductors', 'transportista'])->findOrFail($id);

        // Datos que se enviarán a la vista PDF
        $data = [
            'guia' => $guia,
            'format' => $format,
        ];

        // Seleccionamos la vista según formato
        $view = $format === 'ticket'
            ? 'admin.pdf.guias.ticket'
            : 'admin.pdf.guias.a4';

        // Renderizamos PDF
        $pdf = Pdf::loadView($view, $data)
            ->setPaper($format === 'ticket' ? [0, 0, 226.77, 600] : 'A4'); // 80mm ticket width

        // Si quieres mostrarlo en el navegador
        return $pdf->stream("Guia_{$guia->serienumero}.pdf");

        // Si quieres descargarlo:
        // return $pdf->download("Guia_{$guia->serienumero}.pdf");
    }
}
