<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Descarga PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>

    <div class="row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <img src="{{ asset('modules/ptventa/images/sena.jpg') }}" alt="">
        </div>
        <div class="col-sm-8 mb-3 mb-sm-0">
            <h1 class="text-center">INFORME LISTA DE PRODUCTOS</h1>
            <P class="text-center">CENTRO DE FORMACION AGROINDUSTRIAL LA "ANGOSTURA"</P>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
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
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

