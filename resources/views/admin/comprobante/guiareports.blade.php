<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia de Remisión</title>
    <style>
        @page {
            margin: 0;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            width: 7.5cm;
            margin-left: 5px;
            /* Agregamos un pequeño margen a la izquierda */
            margin-right: 15px;
            background-color: white;
            padding: 0;
            font-size: 9px;
        }

        div {
            padding: 0;
        }

        h1 {
            font-size: 12px;
            margin: 0;
            text-align: center;
        }

        h4 {
            font-size: 10px;
            margin: 5px 0;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        p {
            margin: 2px 0;
            font-size: 9px;
            line-height: 1.2;
            overflow-wrap: break-word;
        }

        table {
            width: 98%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 5px;
        }

        th,
        td {
            border: 0px solid black;
            padding: 4px;
            font-size: 9px;
            word-wrap: break-word;
        }

        th.producto {
            width: 50%;
            /* Ajusta el porcentaje según lo que necesites */
        }

        th.can,
        th.pre,
        th.total {
            width: 16.66%;
            /* Ajusta estos porcentajes según lo que necesites */
        }

        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4) {
            width: 15%;
            /* Ajusta según tus necesidades */
        }


        td {
            text-align: left;
            vertical-align: top;
        }

        th {
            text-align: right;
            /* Alinea el texto a la derecha en los encabezados */
        }

        /* Alineación de montos a la derecha */
        .amount {
            text-align: right;
        }

    </style>
</head>

<body>
    <div>
        {{-- <img src="images/ticom.jpg" alt="Logo Empresa"> --}}
        <h1>{{ $company->razonsocial }}</h1>

        {{-- <img src="{{ Storage::disk('s3')->url($company->logo) }}" style="max-width: 100%;" alt=""> --}}

        {{-- <img src="{{ Storage::disk('s3')->url($company->logo) }}" width="200px" alt=""> --}}
        <p>RUC: {{ $company->ruc }}</p>
        <p>DIRECCIÓN: {{ $company->direccion }}</p>

        <h4>GUIA ELECTRONICA</h4>
        <p>{{ $boleta->serie }} - {{ $boleta->numero }}</p>
        <p>Fecha: {{ $boleta->fechaemision }}</p>
        <hr>
        {{-- <p>CLIENTE: {{ $comprobante->customer->nomrazonsocial }} </p> --}}
        <p style="word-wrap: break-word; overflow-wrap: break-word;">
            CLIENTE: {{ $boleta->customer->nomrazonsocial }}
        </p>
        {{-- <p>DIRECCIÓN: {{ $comprobante->customer->address }} </p> --}}

        <p style="word-wrap: break-word; overflow-wrap: break-word;">
            DIRECCIÓN: {{ $boleta->customer->address }}
        </p>

        <p>FORMA PAGO: CONTADO </p>
        <hr>
        <!-- Otros datos del comprobante -->
        <table>
            <thead>
                <tr>
                    <th class="pre text-right">item</th>
                    <th class="producto text-right">Producto</th>
                    <th class="can text-right">Cant</th>
                   
                </tr>
            </thead>

            <tbody>
                {{-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
                <!-- Detalles de los productos -->
                @foreach ( $temporals as $temporal )
                <tr>
                    <td>item</td>
                    <td>{{ $temporal->name }}</td>
                    <td class="amount">{{ $temporal->quantity }} </td>
                    {{-- <td>{{ number_format($temporal->saleprice, 2) }}</td>
                    <td>{{ number_format($temporal->saleprice * $temporal->quantity, 2) }}</td> --}}
                   
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>

        <!-- Totales en números y letras -->
        <p> </p>
       
        <hr>
        <p>aqui va el codigo QR</p>
        <hr>
        <p>ghfgf43fdgfdqa2gfhgfhgfh=-+gfhgf</p>
        <P>Representación electrónica de la boleta electrónica</P>
        <p>Este documento puede ser consultado</p>
        <p>en www.ticomperu.com</p>
        <p>Autorizado mediante resolución </p>
        <p>de intendencia Nro 034.005-0007633/SUNAT</p>
    </div>
</body>

</html>
