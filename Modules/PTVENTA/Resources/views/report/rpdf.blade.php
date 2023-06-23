<!doctype html>
<html lang="en">
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

        .short-header3 {
            width: 7%;
            padding: 5px;
        }

        .short-header4 {
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
                <th class="short-header">
                    <img src="{{ asset('modules/ptventa/images/sena.jpg') }}" style="width: 85px; height: 65px;" >
                </th>
                <th class="long-header">
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
                            <th class="centrar-texto short-header3" scope="col">#</th>
                            <th class="centrar-texto short-header2" scope="col">Comprobante</th>
                            <th class="long-header2">Producto</th>
                            <th class="centrar-texto short-header2" scope="col">Fecha</th>
                            <th class="centrar-texto short-header2" scope="col">Precio</th>
                            <th class="centrar-texto short-header4" scope="col">Cantidad</th>
                            <th class="centrar-texto short-header2" scope="col">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="centrar-texto short-header3">1</td>
                            <td class="centrar-texto short-header2">123</td>
                            <td class="long-header2">YOGURT DE MORA X 25ML</td>
                            <td class="centrar-texto short-header2">08/06/2023</td>
                            <td class="centrar-texto short-header2">2000</td>
                            <td class="centrar-texto short-header4">5</td>
                            <td class="centrar-texto short-header2">10000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">2</td>
                            <td class="centrar-texto short-header2">456</td>
                            <td class="long-header2">DONA DE CHOCOLATE X 50GR</td>
                            <td class="centrar-texto short-header2">10/05/2023</td>
                            <td class="centrar-texto short-header2">1000</td>
                            <td class="centrar-texto short-header4">10</td>
                            <td class="centrar-texto short-header2">10000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">3</td>
                            <td class="centrar-texto short-header2">789</td>
                            <td class="long-header2">QUESILLO X 100GR</td>
                            <td class="centrar-texto short-header2">01/04/2023</td>
                            <td class="centrar-texto short-header2">4000</td>
                            <td class="centrar-texto short-header4">10</td>
                            <td class="centrar-texto short-header2">40000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">4</td>
                            <td class="centrar-texto short-header2">398</td>
                            <td class="long-header2">SALCHICHON X 300GR</td>
                            <td class="centrar-texto short-header2">11/06/2023</td>
                            <td class="centrar-texto short-header2">10000</td>
                            <td class="centrar-texto short-header4">20</td>
                            <td class="centrar-texto short-header2">200000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">5</td>
                            <td class="centrar-texto short-header2">739</td>
                            <td class="long-header2">PAN DE YUCA X 20GR</td>
                            <td class="centrar-texto short-header2">03/05/2023</td>
                            <td class="centrar-texto short-header2">1000</td>
                            <td class="centrar-texto short-header4">30</td>
                            <td class="centrar-texto short-header2">30000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">6</td>
                            <td class="centrar-texto short-header2">013</td>
                            <td class="long-header2">NECTAR DE GUANABANA X 30ML</td>
                            <td class="centrar-texto short-header2">24/05/2023</td>
                            <td class="centrar-texto short-header2">1500</td>
                            <td class="centrar-texto short-header4">30</td>
                            <td class="centrar-texto short-header2">45000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">7</td>
                            <td class="centrar-texto short-header2">519</td>
                            <td class="long-header2">ARROZ CON LECHE X 70GR</td>
                            <td class="centrar-texto short-header2">29/05/2023</td>
                            <td class="centrar-texto short-header2">2000</td>
                            <td class="centrar-texto short-header4">10</td>
                            <td class="centrar-texto short-header2">20000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">8</td>
                            <td class="centrar-texto short-header2">017</td>
                            <td class="long-header2">SEVILLANA X 25ML</td>
                            <td class="centrar-texto short-header2">08/06/2023</td>
                            <td class="centrar-texto short-header2">1500</td>
                            <td class="centrar-texto short-header4">20</td>
                            <td class="centrar-texto short-header2">30000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">9</td>
                            <td class="centrar-texto short-header2">823</td>
                            <td class="long-header2">FIGURAS DE CHOCOLATE X 10GR</td>
                            <td class="centrar-texto short-header2">18/04/2023</td>
                            <td class="centrar-texto short-header2">800</td>
                            <td class="centrar-texto short-header4">30</td>
                            <td class="centrar-texto short-header2">24000</td>
                        </tr>
                        <tr>
                            <td class="centrar-texto short-header3">10</td>
                            <td class="centrar-texto short-header2">193</td>
                            <td class="long-header2">PAN X 10GR</td>
                            <td class="centrar-texto short-header2">04/06/2023</td>
                            <td class="centrar-texto short-header2">1000</td>
                            <td class="centrar-texto short-header4">50</td>
                            <td class="centrar-texto short-header2">50000</td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <th>Total:</th>
                            <td>459000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
