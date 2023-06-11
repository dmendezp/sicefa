<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Descarga PDF</title>
        <link rel="stylesheet" href=" {{ asset('libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}" crossorigin="anonymus">
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
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">456</td>
                            <td>DONA DE CHOCOLATE X 50GR</td>
                            <td class="text-center">10/05/2023</td>
                            <td class="text-center">1000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">10000</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">789</td>
                            <td>QUESILLO X 100GR</td>
                            <td class="text-center">01/04/2023</td>
                            <td class="text-center">4000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">40000</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">398</td>
                            <td>SALCHICHON X 300GR</td>
                            <td class="text-center">11/06/2023</td>
                            <td class="text-center">10000</td>
                            <td class="text-center">20</td>
                            <td class="text-center">200000</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">739</td>
                            <td>PAN DE YUCA X 20GR</td>
                            <td class="text-center">03/05/2023</td>
                            <td class="text-center">1000</td>
                            <td class="text-center">30</td>
                            <td class="text-center">30000</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">013</td>
                            <td>NECTAR DE GUANABANA X 30ML</td>
                            <td class="text-center">24/05/2023</td>
                            <td class="text-center">1500</td>
                            <td class="text-center">30</td>
                            <td class="text-center">45000</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">519</td>
                            <td>ARROZ CON LECHE X 70GR</td>
                            <td class="text-center">29/05/2023</td>
                            <td class="text-center">2000</td>
                            <td class="text-center">10</td>
                            <td class="text-center">20000</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">017</td>
                            <td>SEVILLANA X 25ML</td>
                            <td class="text-center">08/06/2023</td>
                            <td class="text-center">1500</td>
                            <td class="text-center">20</td>
                            <td class="text-center">30000</td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td class="text-center">823</td>
                            <td>FIGURAS DE CHOCOLATE X 10GR</td>
                            <td class="text-center">18/04/2023</td>
                            <td class="text-center">800</td>
                            <td class="text-center">30</td>
                            <td class="text-center">24000</td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td class="text-center">193</td>
                            <td>PAN X 10GR</td>
                            <td class="text-center">04/06/2023</td>
                            <td class="text-center">1000</td>
                            <td class="text-center">50</td>
                            <td class="text-center">50000</td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <th>Total:</th>
                            <td>459000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
