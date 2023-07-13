<!DOCTYPE html>
<html>

<head>
    <style>
        @media print {
            .oculto-impresion {
                display: none;
            }

            .ticket {
                background-color: #f9f9f9;
                padding: 10px;
                margin: 0;
                font-family: 'Tahoma', Arial, sans-serif !important;
                color: #000000;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
            }

            .custom-style {
                font-size: 15px;
                border-bottom: 1px solid #000000;
                color: #000000;
            }

            .custom-p{
                margin-bottom: 5px;
            }

            .total-row td {
                font-weight: bold;
            }

            .empresa {
                text-align: center;
                margin-bottom: 15px;
            }

            .description {
                text-align: left;
                font-size: 12px;
                color: #000000;
            }

            .empresa>* {
                margin-top: 0;
                margin-bottom: 0;
                line-height: 1;
            }

            .description td {
                padding-top: 5px;
                padding-bottom: 5px;
            }
        }

        @media print and (max-width: 500px) {
            .ticket {
                padding: 5px;
            }

            .description {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="empresa">
            <h2 style="font-size: 18px;" class="custom-p">CENTRO DE FORMACIÓN AGROINDUSTRIAL</h2>
            <p class="custom-p">Nit. 899.999.34-1</p>
            <p class="custom-p">Producción de Centro - SENA Empresa</p>
            <p class="custom-p">La Angostura</p>
            <p class="custom-p">Art 17 Decreto 1001 de 1997</p>
        </div>
        <div class="description">
            <table>
                <tr>
                    <td style="padding-bottom: 0;">Fecha:</td>
                    <td style="padding-bottom: 0;"><span id="fechaHora"></span></td>
                </tr>
                <tr>
                    <td style="padding-top: 0; padding-bottom: 0;">Cliente:</td>
                    <td style="padding-top: 0; padding-bottom: 0;">PUNTO DE VENTA</td>
                </tr>
                <tr>
                    <td style="padding-top: 0; padding-bottom: 0;">Identificación:</td>
                    <td style="padding-top: 0; padding-bottom: 0;">1234567890</td>
                </tr>
                <tr>
                    <td style="padding-top: 0;">Atendido por:</td>
                    <td style="padding-top: 0;">LOLA FERNADA HERRERA HERNANDEZ</td>
                </tr>
            </table>
        </div>
        <table>
            <thead>
                <tr class="custom-style">
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cant</th>
                    <th>V.Unit</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="custom-style">
                    <td>1</td>
                    <td>PAN DE YUCA X UNIDAD</td>
                    <td>48</td>
                    <td>$1.100</td>
                    <td>$52.800</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ANGEL CAKE X UNIDAD</td>
                    <td>13</td>
                    <td>$1.300</td>
                    <td>$16.900</td>
                </tr>
                <tr class="total-row custom-style">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td>$69.700</td>
                </tr>
            </tbody>
        </table>
        <div class="empresa">
            <p style="margin-bottom: 5px; margin-top: 5px;">Gracias por su compra</p>
            <p style="margin-bottom: 5px;">Vuelva Pronto!</p>
        </div>
    </div>

    <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>

    <script>
        function imprimir() {
            window.print();
        }

        // Obtener la fecha y hora actual
        var fechaHoraElement = document.getElementById("fechaHora");
        var fechaHoraActual = new Date().toLocaleString();
        fechaHoraElement.textContent = fechaHoraActual;
    </script>
</body>

</html>
