<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta</title>
    <style>
        @page {
            margin: 6px 8px;
            /* top/bottom 6px - left/right 8px */
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            width: 6.8cm;
            /* ⬅️ REDUCE ancho útil */
            margin: 0;
            padding: 0;
            background-color: white;
            font-size: 9px;
        }

        .center {
            text-align: center;
        }

        .muted {
            color: #444;
        }

        .bold {
            font-weight: 700;
        }

        .company-name {
            font-size: 14px;
            font-weight: 800;
            margin: 0;
            line-height: 1.15;
            text-transform: uppercase;
        }

        .company-meta {
            margin-top: 3px;
            line-height: 1.25;
            font-size: 9px;
        }

        .divider {
            border: none;
            border-top: 1px dashed #666;
            margin: 6px 0;
        }

        .box {
            border: none !important;
            padding: 6px 6px;
            margin-top: 6px;
        }

        .doc-title {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
            margin: 0;
            text-transform: uppercase;
        }

        .doc-number {
            font-size: 12px;
            font-weight: 800;
            margin: 2px 0 0 0;
            letter-spacing: .3px;
        }

        .row {
            display: block;
            margin: 2px 0;
            line-height: 1.25;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .label {
            font-weight: 700;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 4px;
        }

        thead th {
            font-size: 9px;
            padding: 4px 2px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
        }

        tbody td {
            font-size: 9px;
            padding: 4px 2px;
            vertical-align: top;
        }

        td,
        th {
            white-space: nowrap;
        }

        .col-prod {
            width: 48%;
            text-align: left;
        }

        .col-qty {
            width: 12%;
            text-align: right;
        }

        .col-pu {
            width: 20%;
            text-align: right;
        }

        .col-tot {
            width: 20%;
            text-align: right;
        }

        .amount {
            text-align: right;
        }

        .totals {
            width: 100%;
            margin-top: 4px;
            border-top: 1px dashed #666;
            padding-top: 4px;
        }

        .totals table td {
            padding: 2px 4px;
            font-size: 9px;
        }

        .totals .key {
            text-align: left;
        }

        .totals .val {
            text-align: right;
        }

        .grand-total {
            font-weight: 900;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 4px;
            margin-top: 4px;
        }

        .words {
            margin-top: 4px;
            font-size: 9px;
            line-height: 1.25;
        }

        .qr-wrap {
            text-align: center;
            margin-top: 6px;
        }

        .qr-img {
            width: 140px;
            height: 140px;
            display: block;
            margin: 6px auto 0 auto;
        }

        .footer {
            text-align: center;
            margin-top: 6px;
            font-size: 8px;
            line-height: 1.25;
        }

        .hash {
            font-size: 7.5px;
            word-break: break-all;
            line-height: 1.2;
            margin-top: 4px;
        }

        .center {
            text-align: center;
        }

        .box {
            margin-top: 6px;
        }

        .doc-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: .3px;
        }

        .doc-number {
            font-size: 10px;
            font-weight: bold;
            margin-top: 2px;
        }

        /* ✅ Fecha sin borde */
        .date-pill {
            display: inline-block;
            margin-top: 6px;
            padding: 0;
            border: none !important;
            border-radius: 0;
            font-size: 10px;
        }

        .date-label {
            font-weight: bold;
            margin-right: 6px;
        }

        .date-value {
            font-weight: bold;
        }


        .qr-wrap {
            text-align: center;
            margin-top: 6px;
        }

        .qr-img {
            width: 140px;
            height: 140px;
            display: block;
            margin: 0 auto;
        }

        /* ✅ Hash bien visible */
        .hash-box {
            display: block;
            margin: 8px auto 0 auto;
            padding: 0;
            border: none !important;
            border-radius: 0;
            width: 95%;
            text-align: center;
        }

        .hash-label {
            font-size: 9px;
            font-weight: bold;
            letter-spacing: .6px;
            margin-bottom: 3px;
        }

        .hash-value {
            font-size: 10px;
            /* ⬅️ más grande */
            font-weight: bold;
            /* ⬅️ contraste */
            word-break: break-all;
            /* ⬅️ que no se salga */
            line-height: 1.2;
        }
    </style>
</head>

<body>

    {{-- ENCABEZADO EMPRESA --}}
    <div class="center">
        <div class="company-name">{{ $company->razonsocial }}</div>

        <div class="company-meta">
            <div class="row"><span class="label">RUC:</span> {{ $company->ruc }}</div>
            <div class="row"><span class="label">DIRECCIÓN:</span> {{ $company->direccion }}</div>
        </div>
    </div>

    <hr class="divider">

    {{-- CAJA DOCUMENTO --}}
    {{-- <div class="box center">
        <div class="doc-title">BOLETA ELECTRÓNICA</div>
        <div class="doc-number">{{ $boleta->serie }} - {{ $boleta->numero }}</div>
        <div class="row muted" style="margin-top:3px;">
            <span class="label">FECHA:</span> {{ $boleta->fechaemision }}
        </div>
    </div> --}}

    <div class="box center">
        <div class="doc-title">NOTA DE CREDITO BOLETA ELECTRÓNICA</div>
        <div class="doc-number">{{ $boleta->serie }} - {{ $boleta->numero }}</div>

        <div class="date-pill">
            <span class="date-label">FECHA</span>
            <span class="date-value">
                {{ \Carbon\Carbon::parse($boleta->fechaemision)->format('d/m/Y') }}
            </span>
        </div>
    </div>

    <hr class="divider">

    {{-- DATOS CLIENTE --}}
    <div>
        <div class="row">
            <span class="label">CLIENTE:</span> {{ $comprobante->customer->nomrazonsocial }}
        </div>
        <div class="row">
            <span class="label">DIRECCIÓN:</span> {{ $comprobante->customer->address }}
        </div>
       {{--  <div class="row">
            <span class="label">FORMA PAGO:</span> {{ $comprobante->paymenttype->name }}
        </div> --}}
    </div>

    <hr class="divider">

    {{-- DETALLE --}}
    <table>
        <thead>
            <tr>
                <th class="col-prod">Producto</th>
                <th class="col-qty">Cant</th>
                <th class="col-pu">P/U</th>
                <th class="col-tot">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($temporals as $temporal)
                <tr>
                    <td class="col-prod">{{ $temporal->name }}</td>
                    <td class="col-qty amount">{{ $temporal->quantity }}</td>
                    <td class="col-pu amount">{{ number_format($temporal->saleprice, 2) }}</td>
                    <td class="col-tot amount">{{ number_format($temporal->saleprice * $temporal->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTALES --}}
    <div class="totals">
        <table>
            <tr>
                <td class="key">Ope. Gravadas</td>
                <td class="val">{{ number_format($comprobante->valorventa, 2) }}</td>
            </tr>
            <tr>
                <td class="key">ICBPER</td>
                <td class="val">{{ number_format($comprobante->icbper, 2) }}</td>
            </tr>
            <tr>
                <td class="key">IGV</td>
                <td class="val">{{ number_format($comprobante->mtoigv, 2) }}</td>
            </tr>
            <tr>
                <td class="key grand-total">TOTAL</td>
                <td class="val grand-total">{{ number_format($total, 2) }}</td>
            </tr>
        </table>

        <div class="words">
            <span class="label">SON:</span> {{ $totalenletras }} Soles
        </div>
    </div>

    <hr class="divider">

    {{-- QR --}}
    {{-- <div class="qr-wrap">
        
        <img class="qr-img" src="data:image/svg+xml;base64,{{ $qrBase64 }}" alt="QR SUNAT" />
        <div class="hash muted">{{ $boleta->hash }}</div>
    </div> --}}

    <div class="qr-wrap">
        <img class="qr-img" src="data:image/svg+xml;base64,{{ $qrBase64 }}" alt="QR SUNAT" />

        <div class="hash-box">

            @php
                $hashFmt = trim(chunk_split($boleta->hash ?? '', 32, ' '));
            @endphp

            <div class="hash-label">HASH</div>

            <div class="hash-value">{{ $hashFmt }}</div>
        </div>
    </div>

    <hr class="divider">

    {{-- PIE --}}
    <div class="footer">
        <div class="bold">Representación impresa de la boleta electrónica</div>
        <div>Este documento puede ser consultado en</div>
        <div class="bold">www.ticomperu.com</div>
        <div>Autorizado mediante Resolución de Intendencia</div>
        <div>N° 034.005-0007633/SUNAT</div>
    </div>

</body>

</html>