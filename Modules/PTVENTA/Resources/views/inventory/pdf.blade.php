<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte PDF</title>
    <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <img src="{{ asset('modules/ptventa/images/sena.jpg') }}" alt="">
        </div>
        <div class="col-sm-8 mb-3 mb-sm-0">
            <h1 class="text-center">INFORME LISTA DE PRODUCTOS</h1>
            <P class="text-center">CENTRO DE FORMACION AGROINDUSTRIAL LA "ANGOSTURA"</P>
        </div>
        <table class="table table-striped">
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

    <script src="{{ public_path('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>