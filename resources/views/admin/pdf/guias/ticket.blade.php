<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guía {{ $guia->serienumero }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; width: 220px; }
        .center { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        td, th { padding: 2px; border-bottom: 1px dashed #000; }
        .small { font-size: 9px; }
    </style>
</head>
<body>
    <div class="center">
        <strong>{{ $guia->company->razonsocial }}</strong><br>
        RUC: {{ $guia->company->ruc }}<br>
        GUÍA: {{ $guia->serienumero }}<br>
        {{ $guia->fechaemision }}
    </div>

    <hr>

    <div>
        <strong>Cliente:</strong> {{ $guia->customer->nomrazonsocial }}<br>
        <strong>RUC:</strong> {{ $guia->customer->numdoc }}
    </div>

    <table>
        <thead>
            <tr><th>Producto</th><th>Cant</th></tr>
        </thead>
        <tbody>
            @foreach (json_decode($guia->details) as $item)
                <tr>
                    <td>{{ $item->codigobarras }}</td>
                    <td>{{ $item->name ?? '' }}</td>
                    <td>{{ $item->cant }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <div class="center small">
        {{ $guia->company->direccion ?? '' }}<br>
        Guía generada electrónicamente.
    </div>
</body>
</html>
