<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nota de Crédito</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .ticket {
            width: 210px; /* Ancho aprox del papel */
            margin: 0 auto;
            padding: 5px 5px 10px 5px;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
        .left {
            text-align: left;
        }
        .bold {
            font-weight: bold;
        }
        .mt-5 { margin-top: 5px; }
        .mt-10 { margin-top: 10px; }
        .mb-5 { margin-bottom: 5px; }
        .mb-10 { margin-bottom: 10px; }
        .border-top {
            border-top: 1px solid #000;
        }
        .border-bottom {
            border-bottom: 1px solid #000;
        }
        .border {
            border: 1px solid #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th,
        table td {
            padding: 2px;
        }
        table.items th,
        table.items td {
            border-bottom: 1px dashed #000;
        }
        .small {
            font-size: 9px;
        }
        .very-small {
            font-size: 8px;
        }
    </style>
</head>
<body>
@php
    // Moneda simple (ajusta según tus IDs reales)
    $currencySymbol = $boleta->currency_id == 2 ? '$' : 'S/';

    // Intenta obtener el comprobante asociado (si el modelo tiene la relación)
    $comprobante = $boleta->comprobante ?? null;

    // Cliente (si existe relación customer en comprobante)
    $customer = $comprobante ? ($comprobante->customer ?? null) : null;

    // Monto en letras desde legends (json en comprobante->legends)
    $montoEnLetras = '';
    if ($comprobante && $comprobante->legends) {
        $legendsArr = json_decode($comprobante->legends, true);
        if (is_array($legendsArr)) {
            foreach ($legendsArr as $legend) {
                if (isset($legend['code']) && $legend['code'] == '1000') {
                    $montoEnLetras = $legend['value'] ?? '';
                    break;
                }
            }
        }
    }

    // Totales desde temporals (similar a tu lógica en Livewire)
    $gravadas = $temporals->where('tipafeigv', '10')->sum('mtovalorventa');
    $exoneradas = $temporals->where('tipafeigv', '20')->sum('mtovalorventa');
    $inafectas = $temporals->where('tipafeigv', '30')->sum('mtovalorventa');
    $exportacion = $temporals->where('tipafeigv', '40')->sum('mtovalorventa');
    $gratuitas = $temporals->whereNotIn('tipafeigv', ['10', '20', '30', '40'])->sum('mtovalorventa');

    $igv = $temporals->whereIn('tipafeigv', ['10', '20', '30', '40'])->sum('igv');
    $igvGratuitas = $temporals->whereNotIn('tipafeigv', ['10', '20', '30', '40'])->sum('igv');

    $icbper = $temporals->where('esbolsa', 1)->sum('icbper');

    $totalImpuestos = $igv + $icbper;
    $totalImporte   = $temporals->sum('subtotal'); // total con IGV

    // Tipo de documento afectado
    $docAfectado = $boleta->tipodocumentoafectado ?? '';
    if ($docAfectado == '01') {
        $docAfectadoTexto = 'FACTURA';
    } elseif ($docAfectado == '03') {
        $docAfectadoTexto = 'BOLETA';
    } else {
        $docAfectadoTexto = 'COMPROBANTE';
    }
@endphp

<div class="ticket">

    {{-- ENCABEZADO EMPRESA --}}
    <div class="center mb-5">
        @if(!empty($company->logo_path ?? null))
            {{-- Si manejas logo en storage, puedes adaptarlo; Dompdf necesita ruta absoluta o pública --}}
            <img src="{{ public_path($company->logo_path) }}" alt="Logo" style="max-width:120px; max-height:60px;">
        @endif
        <div class="bold">{{ $company->razonsocial ?? '' }}</div>
        <div class="small">{{ $company->tradename ?? '' }}</div>
        <div class="small">RUC: {{ $company->ruc ?? '' }}</div>
        <div class="very-small">
            {{ $company->address ?? '' }}<br>
            {{ $company->district ?? '' }} - {{ $company->province ?? '' }} - {{ $company->department ?? '' }}
        </div>
    </div>

    {{-- INFORMACIÓN DE LA NOTA DE CRÉDITO --}}
    <div class="center border-top border-bottom mb-5">
        <div class="bold small">NOTA DE CRÉDITO ELECTRÓNICA</div>
        <div class="bold">{{ $boleta->serie ?? '' }}-{{ str_pad($boleta->numero ?? 0, 8, '0', STR_PAD_LEFT) }}</div>
    </div>

    {{-- DATOS GENERALES --}}
    <table>
        <tr>
            <td class="very-small">Fecha Emisión:</td>
            <td class="very-small right">{{ \Carbon\Carbon::parse($boleta->fechaemision)->format('d/m/Y') }}</td>
        </tr>
        @if($customer)
            <tr>
                <td class="very-small">Cliente:</td>
                <td class="very-small right">{{ $customer->name ?? '' }}</td>
            </tr>
            <tr>
                <td class="very-small">Documento:</td>
                <td class="very-small right">
                    {{ $customer->numdoc ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="very-small">Dirección:</td>
                <td class="very-small right">
                    {{ $customer->address ?? '' }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="very-small">Doc. Afectado:</td>
            <td class="very-small right">
                {{ $docAfectadoTexto }} {{ $boleta->numdocumentoafectado ?? $boleta->serienumeroafectado ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="very-small">Motivo:</td>
            <td class="very-small right">{{ $boleta->desmotivo ?? '' }}</td>
        </tr>
    </table>

    {{-- DETALLE DE ITEMS --}}
    <div class="mt-10 mb-5 border-top border-bottom">
        <table class="items">
            <thead>
                <tr class="very-small">
                    <th class="left" style="width: 12%;">Cant.</th>
                    <th class="left" style="width: 12%;">Und.</th>
                    <th class="left" style="width: 46%;">Descripción</th>
                    <th class="right" style="width: 15%;">V/U</th>
                    <th class="right" style="width: 15%;">Importe</th>
                </tr>
            </thead>
            <tbody>
            @foreach($temporals as $item)
                @php
                    $cantidad = $item->quantity;
                    $unidad   = $item->um ?? '';
                    $nombre   = $item->name ?? '';
                    // Precio sin IGV
                    $valorUnitario = $item->mtovalorunitario ?? 0;
                    $importeLinea  = $item->subtotal ?? 0;
                @endphp
                <tr class="very-small">
                    <td class="left">{{ number_format($cantidad, 2) }}</td>
                    <td class="left">{{ $unidad }}</td>
                    <td class="left">{{ $nombre }}</td>
                    <td class="right">{{ $currencySymbol }} {{ number_format($valorUnitario, 2) }}</td>
                    <td class="right">{{ $currencySymbol }} {{ number_format($importeLinea, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- TOTALES --}}
    <table class="mt-5">
        <tr class="very-small">
            <td class="left">Op. Gravadas</td>
            <td class="right">{{ $currencySymbol }} {{ number_format($gravadas, 2) }}</td>
        </tr>
        @if($exoneradas > 0)
            <tr class="very-small">
                <td class="left">Op. Exoneradas</td>
                <td class="right">{{ $currencySymbol }} {{ number_format($exoneradas, 2) }}</td>
            </tr>
        @endif
        @if($inafectas > 0)
            <tr class="very-small">
                <td class="left">Op. Inafectas</td>
                <td class="right">{{ $currencySymbol }} {{ number_format($inafectas, 2) }}</td>
            </tr>
        @endif
        @if($exportacion > 0)
            <tr class="very-small">
                <td class="left">Op. Exportación</td>
                <td class="right">{{ $currencySymbol }} {{ number_format($exportacion, 2) }}</td>
            </tr>
        @endif
        @if($gratuitas > 0)
            <tr class="very-small">
                <td class="left">Op. Gratuitas</td>
                <td class="right">{{ $currencySymbol }} {{ number_format($gratuitas, 2) }}</td>
            </tr>
        @endif
        <tr class="very-small">
            <td class="left">ICBPER</td>
            <td class="right">{{ $currencySymbol }} {{ number_format($icbper, 2) }}</td>
        </tr>
        <tr class="very-small">
            <td class="left">IGV</td>
            <td class="right">{{ $currencySymbol }} {{ number_format($igv, 2) }}</td>
        </tr>
        <tr class="very-small bold border-top">
            <td class="left">TOTAL</td>
            <td class="right">
                {{ $currencySymbol }} {{ number_format($boleta->total ?? $totalImporte, 2) }}
            </td>
        </tr>
    </table>

    {{-- MONTO EN LETRAS --}}
    @if(!empty($montoEnLetras))
        <div class="mt-5 very-small">
            <span class="bold">SON: </span>{{ $montoEnLetras }}
        </div>
    @endif

    {{-- NOTA / OBSERVACIONES --}}
    @if($comprobante && !empty($comprobante->nota))
        <div class="mt-5 very-small">
            <span class="bold">Obs.: </span>{{ $comprobante->nota }}
        </div>
    @endif

    {{-- PIE --}}
    <div class="mt-10 center very-small">
        Representación impresa de la Nota de Crédito Electrónica.<br>
        Consulte su comprobante en SUNAT o en el portal de la empresa.
    </div>

</div>
</body>
</html>
