<!doctype html>
<htmll ang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Descarga PDF</title>
        <link rel="stylesheet" href=" {{ asset('libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}" crossorigin="anonymus">
    </head>
  <body>
    <style>
        .centrar-texto {
            text-align: center;
         }

         .long-header {
            width: 80%;
            padding: 10px;
        }

        .short-header {
            width: 20%;
            padding: 5px;
        }

        .short-header2 {
            width: 14%;
            padding: 5px;
        }

        .small-header {
            font-size: 8px;
            /* Otros estilos... */
        }

        .short-header3 {
            width: 7%;
            padding: 5px;
        }

        .short-header4 {
            width: 9.5%;
            padding: 5px;
        }

        .short-header5 {
            width: 9.5%;
            padding: 5px;
        }

        .long-header2 {
            width: 34%;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th class="short-header small-header">
                    <img src="{{ asset('modules/ptventa/images/sena.jpg') }}" style="width: 85px; height: 65px;" >
                </th>
                <th class="long-header small-header">
                    <div class="centrar-texto">
                        <h1>INFORME LISTA DE PRODUCTOS</h1>
                        <P>CENTRO DE FORMACION AGROINDUSTRIAL LA "ANGOSTURA"</P>
                    </div>
                </th>
            </tr>
        </table>
    </div>
            <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                        <th>Producto</th>
                        <th class="text-center">Categoría</th>
                        <th class="text-center">Precio Unitario</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Estado</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                    <tr>
                            <td><strong>{{ $inventory->element->name }}</strong></td>
                            <td class="text-center">{{ $inventory->element->category->name }}</td>
                            <td class="text-center"><strong>{{ $inventory->stock }}</strong></td>
                            <td class="text-center">{{ $inventory->amount }}</td>
                            <td class="text-center"><strong>{{ $inventory->amount }}</strong></td>
                            <td class="text-center">
                                @if ($inventory->state == 'Disponible')
                                    <b class="bg-success rounded-5 ps-2 pe-2" style="font-size: 12px;">Disponible</b>
                                @else
                                    <b class="bg-gradient-dark rounded-5 ps-2 pe-2" style="font-size: 12px;">No disponible</b>
                                @endif
                            </td>
                        </tr>
                   @endforeach
                </tbody>
                </table>
            </div>
        <script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
