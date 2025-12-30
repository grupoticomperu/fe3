<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta A4</title>
    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: 700;
        }

        .muted {
            color: #555;
        }

        .h1 {
            font-size: 14px;
            font-weight: 800;
            margin: 0;
            text-transform: uppercase;
        }

        .h2 {
            font-size: 12px;
            font-weight: 800;
            margin: 0;
            text-transform: uppercase;
        }

        .box {
            border: 1px solid #000;
            border-radius: 6px;
            padding: 8px;
        }

        .box-strong {
            border: 2px solid #000;
            border-radius: 6px;
            padding: 10px;
        }

        .mt-8 {
            margin-top: 8px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-12 {
            margin-top: 12px;
        }

        .small {
            font-size: 10px;
        }

        .xs {
            font-size: 9px;
        }

        /* Layout tables */
        .w-100 {
            width: 100%;
        }

        .no-border {
            border: none !important;
        }

        /* Items table */
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table.items th,
        table.items td {
            border: 1px solid #000;
            padding: 6px 6px;
            vertical-align: top;
        }

        table.items th {
            background: #f3f3f3;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 10px;
        }

        .col-qty {
            width: 9%;
        }

        .col-um {
            width: 10%;
        }

        .col-desc {
            width: 51%;
        }

        .col-pu {
            width: 15%;
        }

        .col-imp {
            width: 15%;
        }

        .nowrap {
            white-space: nowrap;
        }

        /* Totals */
        table.totals {
            width: 100%;
            border-collapse: collapse;
        }

        table.totals td {
            padding: 3px 0;
        }

        .total-line td {
            border-top: 2px solid #000;
            padding-top: 6px;
            font-size: 12px;
            font-weight: 900;
        }

        /* QR */
        .qr {
            width: 130px;
            height: 130px;
        }

        .hash {
            word-break: break-all;
            line-height: 1.25;
            font-size: 9px;
        }

        .footer {
            margin-top: 8px;
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 9px;
            text-align: center;
            line-height: 1.3;
        }

        .logo-box {
            border: 1px solid #000;
            border-radius: 6px;
            height: 80px;
            /* altura fija */
            text-align: center;
            vertical-align: middle;
            padding: 6px;
        }

        .logo-img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>

    {{-- CABECERA: logo | empresa | caja doc --}}
    <table class="w-100" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 25%; vertical-align: top;">
                <div class="logo-box">
                    <img src="{{ Storage::disk('s3_public')->url($company->logo) }}" alt="Logo" class="logo-img">
                </div>
            </td>

            <td style="width: 45%; vertical-align: top; padding-left: 10px;">
                <div class="h1">{{ $company->razonsocial }}</div>
                <div class="small mt-8">
                    <div><span class="bold">RUC:</span> {{ $company->ruc }}</div>
                    <div><span class="bold">DIRECCIÓN:</span> {{ $company->direccion }}</div>
                    {{-- agrega teléfono/email si tienes --}}
                </div>
            </td>

            <td style="width: 30%; vertical-align: top;">
                <div class="box-strong text-center">
                    <div class="bold">R.U.C. {{ $company->ruc }}</div>
                    <div class="h2 mt-8">NOTA DE CREDITO FACTURA <br> ELECTRÓNICA</div>
                    <div class="mt-8 bold" style="font-size: 13px;">
                        {{ $boleta->serie }} - {{ $boleta->numero }}
                    </div>
                </div>
            </td>
        </tr>
    </table>

    {{-- DATOS CLIENTE --}}
    <div class="box mt-12">
        <table class="w-100" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div><span class="bold">Cliente:</span> {{ $comprobante->customer->nomrazonsocial }}</div>
                    <div class="mt-8"><span class="bold">Dirección:</span> {{ $comprobante->customer->address }}
                    </div>
                    <div class="mt-8">
                        <span class="bold">{{ $comprobante->tipodocumento->name ?? 'Doc.' }}:</span>
                        {{ $comprobante->customer->numdoc }}
                    </div>
                </td>

                <td style="width: 50%; vertical-align: top;">
                    <table class="w-100" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="bold">Fecha emisión</td>
                            <td class="text-right">

                                {{ \Carbon\Carbon::parse($boleta->fechaemision)->format('d/m/Y') }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td class="bold mt-8">Cond. de pago</td>
                            <td class="text-right mt-8">{{ $comprobante->paymenttype->name }}</td>
                        </tr> --}}
                        {{-- Si manejas vencimiento, guía, pedido, etc. puedes agregar aquí --}}
                    </table>
                </td>
            </tr>
        </table>
    </div>

    {{-- DETALLE --}}
    <div class="mt-10">
        <table class="items">
            <thead>
                <tr>
                    <th class="col-qty text-center">Cant.</th>
                    <th class="col-um text-center">U.M</th>
                    <th class="col-desc">Descripción</th>
                    <th class="col-pu text-right">P. Unit</th>
                    <th class="col-imp text-right">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($temporals as $temporal)
                    <tr>
                        <td class="text-center nowrap">{{ $temporal->quantity }}</td>
                        <td class="text-center nowrap">{{ $temporal->um ?? 'UND' }}</td>
                        <td>{{ $temporal->name }}</td>
                        <td class="text-right nowrap">{{ number_format($temporal->saleprice, 2) }}</td>
                        <td class="text-right nowrap">
                            {{ number_format($temporal->saleprice * $temporal->quantity, 2) }}</td>
                    </tr>
                @endforeach

                {{-- filas en blanco para “rellenar” y que se vea A4 (opcional) --}}
                @for ($i = count($temporals); $i < 10; $i++)
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- SON + TOTALES --}}
    <table class="w-100 mt-10" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 60%; vertical-align: top; padding-right: 10px;">
                <div class="box">
                    <div class="bold">SON:</div>
                    <div class="mt-8">{{ $totalenletras }} SOLES</div>
                </div>

                <div class="box mt-8">
                    <div class="bold">Observaciones:</div>
                    <div class="muted mt-8">—</div>
                </div>
            </td>

            <td style="width: 40%; vertical-align: top;">
                <div class="box-strong">
                    <table class="totals">
                        <tr>
                            <td class="bold">OP. GRAVADA (S/)</td>
                            <td class="text-right nowrap">{{ number_format($comprobante->valorventa, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="bold">TOTAL IGV (S/)</td>
                            <td class="text-right nowrap">{{ number_format($comprobante->mtoigv, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="bold">ICBPER (S/)</td>
                            <td class="text-right nowrap">{{ number_format($comprobante->icbper, 2) }}</td>
                        </tr>
                        <tr class="total-line">
                            <td>IMPORTE TOTAL (S/)</td>
                            <td class="text-right nowrap">{{ number_format($total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    {{-- QR + HASH --}}
    @php
        $hashFmt = trim(chunk_split($boleta->hash ?? '', 32, ' '));
    @endphp

    <table class="w-100 mt-10" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 35%; vertical-align: top;">
                <div class="box text-center">
                    <img class="qr" src="data:image/svg+xml;base64,{{ $qrBase64 }}" alt="QR SUNAT">
                </div>
            </td>
            <td style="width: 65%; vertical-align: top; padding-left: 10px;">
                <div class="box">
                    <div class="bold">HASH</div>
                    <div class="hash mt-8">{{ $hashFmt }}</div>
                </div>
            </td>
        </tr>
    </table>

    {{-- PIE --}}
    <div class="footer">
        <div class="bold">Representación impresa de la BOLETA DE VENTA ELECTRÓNICA</div>
        <div>Este documento puede ser consultado en <span class="bold">www.ticomperu.com</span></div>
        <div>Autorizado mediante Resolución de Intendencia N° 034.005-0007633/SUNAT</div>
    </div>

</body>

</html>
