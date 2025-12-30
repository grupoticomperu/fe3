<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comprobante; // Ajusta este namespace si tu modelo está en otro lugar
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class FileController extends Controller
{
    /**
     * Genera una URL temporal de S3 para un documento específico.
     * @param Comprobante $comprobante Usamos Route Model Binding de Laravel
     * @param string $type Tipo de archivo a descargar (pdf, xml, cdr)
     */
    public function downloadFile(Comprobante $comprobante, $type)
    {
        // 1. Verificar la propiedad (Opcional pero recomendado: solo si el usuario
        //    puede ver comprobantes de varias compañías, si no, lo cubre el middleware auth)
        // if (auth()->user()->cannot('view', $comprobante)) { 
        //     abort(403, 'Acceso no autorizado al documento.');
        // }

        // 2. Determinar la ruta S3 según el tipo
        if ($comprobante->tipocomprobante_id === 1) {
            $filePath = match ($type) {
                'pdf' => $comprobante->factura->pdf_path,
                'xml' => $comprobante->factura->xml_path,
                'cdr' => $comprobante->factura->cdr_path,
                default => abort(404),
            };
        }


        if ($comprobante->tipocomprobante_id === 2) {
            $filePath = match ($type) {
                'pdf' => $comprobante->boleta->pdf_path,
                'xml' => $comprobante->boleta->xml_path,
                'cdr' => $comprobante->boleta->cdr_path,
                default => abort(404),
            };
        }

        //nota de credito factura
        if ($comprobante->tipocomprobante_id === 3) {
            $filePath = match ($type) {
                'pdf' => $comprobante->ncfactura->pdf_path,
                'xml' => $comprobante->ncfactura->xml_path,
                'cdr' => $comprobante->ncfactura->cdr_path,
                default => abort(404),
            };
        }

        //nota de credito boleta
        if ($comprobante->tipocomprobante_id === 5) {
            $filePath = match ($type) {
                'pdf' => $comprobante->ncboleta->pdf_path,
                'xml' => $comprobante->ncboleta->xml_path,
                'cdr' => $comprobante->ncboleta->cdr_path,
                default => abort(404),
            };
        }

        //guias de remision
        if ($comprobante->tipocomprobante_id === 7) {
            $filePath = match ($type) {
                'pdf' => $comprobante->guia->pdf_path,
                'xml' => $comprobante->guia->xml_path,
                'cdr' => $comprobante->guia->cdr_path,
                default => abort(404),
            };
        }



        // 3. Verificar si la ruta existe
        if (!Storage::disk('s3')->exists($filePath)) {
            abort(404, 'Archivo no encontrado en el servidor de almacenamiento.');
        }

        // 4. Generar la URL Prefirmada (Solo 1 minuto, suficiente para la descarga)
        $expiration = Carbon::now()->addMinutes(1);

        // Genera la URL Temporal Segura de S3
        $urlTemporalSegura = Storage::disk('s3')->temporaryUrl($filePath, $expiration);

        // 5. Redirigir al cliente a la URL de S3 (La mejor opción de rendimiento)
        return redirect()->to($urlTemporalSegura);

        // ALTERNATIVA si quieres que el navegador muestre "download.pdf" en lugar de la URL larga:
        // return Storage::disk('s3')->download($filePath); // Menos eficiente.
    }
}
