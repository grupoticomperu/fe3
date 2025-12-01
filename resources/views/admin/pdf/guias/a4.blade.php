<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guía de Remisión {{ $guia->serienumero }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h2 { margin: 0; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td {
            border: 1px solid #000; padding: 4px; text-align: left;
        }
        .section-title { font-weight: bold; background: #f1f1f1; padding: 4px; margin-top: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $guia->company->razonsocial }}</h2>
        <p>RUC: {{ $guia->company->ruc }}</p>
        <h3>GUÍA DE REMISIÓN - REMITENTE</h3>
        <p>{{ $guia->serienumero }}</p>
    </div>

    <div>
        <div class="section-title">DESTINATARIO</div>
        <p><strong>RUC:</strong> {{ $guia->customer->numdoc }}</p>
        <p><strong>Razón Social:</strong> {{ $guia->customer->nomrazonsocial }}</p>

        <div class="section-title">DATOS DE TRASLADO</div>
        <p><strong>Motivo:</strong> {{ $guia->motivotraslado->description ?? '' }}</p>
        <p><strong>Modalidad:</strong> {{ $guia->modalidaddetraslado == '01' ? 'Público' : 'Privado' }}</p>
        <p><strong>Fecha Traslado:</strong> {{ $guia->fechadetraslado }}</p>
        <p><strong>Peso Total:</strong> {{ $guia->pesototal }} {{ $guia->um->abbreviation ?? '' }}</p>

        @if($guia->modalidaddetraslado == '01' && $guia->transportista)
            <p><strong>Transportista:</strong> {{ $guia->transportista->nomrazonsocial }} ({{ $guia->transportista->numdoc }})</p>
        @else
            @if($guia->vehiculos->first())
                <p><strong>Vehículo:</strong> {{ $guia->vehiculos->first()->numeroplaca }}</p>
            @endif
            @if($guia->conductors->first())
                <p><strong>Conductor:</strong> {{ $guia->conductors->first()->nomape }}</p>
            @endif
        @endif

        <div class="section-title">PRODUCTOS</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($guia->details) as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->codigobarras }}</td>
                        <td>{{ $item->name ?? '' }}</td>
                        <td>{{ $item->cant }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 20px;"><strong>Dirección de llegada:</strong> {{ $guia->direccionllegada }}</p>
    </div>
</body>
</html>
