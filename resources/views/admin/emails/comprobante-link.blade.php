<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante {{ $comprobante->serienumero }}</title>
</head>
<body>

    <p>Hola,</p>

    <p>
        Aquí puedes descargar tu comprobante
        <strong>{{ $comprobante->serienumero }}</strong>:
    </p>

    <p>
        <a href="{{ $pdfUrl }}" target="_blank">
            Descargar Comprobante (PDF)
        </a>
    </p>

    <p>Gracias por tu compra.</p>

</body>
</html>
