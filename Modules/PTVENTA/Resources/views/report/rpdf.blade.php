<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Descarga PDF</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
        <div class="row">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <img src="{{ asset('modules/ptventa/images/sena.jpg') }}" style="width: 80px; height: 60px;" >
            </div>
            <div class="col-sm-8 mb-3 mb-sm-0">
                <h1 class="text-center">INFORME LISTA DE PRODUCTOS</h1>
                <P class="text-center">CENTRO DE FORMACION AGROINDUSTRIAL LA "ANGOSTURA"</P>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Comprobante</th>
                            <th scope="col">Producto</th>
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Precio</th>
                            <th class="text-center" scope="col">Cantidad</th>
                            <th class="text-center" scope="col">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">123</td>
                            <td>YOGURT DE MORA X 25ML</td>
                            <td class="text-center">08/06/2023</td>
                            <td class="text-center">2000</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
