<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Comprobante;
use Illuminate\Support\Facades\Storage;

class ComprobantePdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public Comprobante $comprobante;
    public string $pdfUrl;

    public function __construct(Comprobante $comprobante)
    {
        $this->comprobante = $comprobante->load(['factura', 'boleta', 'ncfactura', 'ncboleta', 'guia']);
        $this->pdfUrl = $this->getPdfUrl();
    }

    protected function getPdfUrl(): string
    {
        $c = $this->comprobante;

        $pdfPath = match ($c->tipocomprobante_id) {
            1 => optional($c->factura)->pdf_path,
            2 => optional($c->boleta)->pdf_path,
            3 => optional($c->ncfactura)->pdf_path,
            5 => optional($c->ncboleta)->pdf_path,
            7 => optional($c->guia)->pdf_path,
            default => null,
        };

        return $pdfPath ? Storage::disk('s3')->url($pdfPath) : '';
    }

    public function build()
    {
        return $this->subject('Comprobante ' . $this->comprobante->serienumero)
            ->view('admin.emails.comprobante-link');
    }

    /* public function envelope()
    {
        return new Envelope(
            subject: 'Comprobante Pdf Mail',
        );
    }


    public function content()
    {
        return new Content(
            view: 'admin.emails.comprobante-pdf', 
        );
    }


    public function attachments()
    {
        return [];
    } */

}
