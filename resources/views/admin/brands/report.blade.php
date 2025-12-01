<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Marcas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center; /* Centra el texto en el cuerpo del documento */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        h1 {
            margin-top: 20px; /* Agrega un espacio en la parte superior para separar el título del borde superior */
        }

        th {
            background-color: #f2f2f2;
        }

        .brand-image {
            width: 60px;
            height: 30px; /* Ajusta el tamaño según tus necesidades */
            object-fit: cover; /* Ajusta la forma de mostrar la imagen */
            border-radius: 10%; /* Hace que la imagen sea redonda */
        }

        .inactive {
            background-color: #FFEBEE;
            color: #D32F2F;
        }

        .active {
            background-color: #E8F5E9;
            color: #43A047;
        }
    </style>
</head>

<body style="width: 15cm;"> {{-- cambio ancho de la impresion --}}
    <img src="{{ public_path() . '/images/ticom.jpg' }}" width="150" height="50" alt="">
    <h1>Listado de Marcas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($brands as $brandd)
                <tr>
                    <td>{{ $brandd->id }}</td>

                    <td>
                        <div class="flex-shrink-0 h-10 w-15">
                            @if ($brandd->image)
                                <img class="brand-image" src="{{ url($brandd->image) }}" alt="{{ $brandd->name }}">
                            @else
                                <img class="brand-image" src="{{ asset('storage/brands/brand-default.jpg') }}"
                                    alt="{{ $brandd->name }}">
                            @endif
                        </div>
                    </td>

                    <td>{{ strtoupper($brandd->name) }}</td>

                    <td class="{{ $brandd->state == 1 ? 'active' : 'inactive' }}">
                        @if ($brandd->state == 1)
                            <span wire:click="desactivar({{ $brandd }})">activo</span>
                        @else
                            <span wire:click="activar({{ $brandd }})">inactivo</span>
                        @endif
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

</body>

</html>
