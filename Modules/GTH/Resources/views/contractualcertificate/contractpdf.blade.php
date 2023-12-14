<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0 80px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
        }

        .header p {
            text-align: justify;
        }

        .contract-info {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .contract-info h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .signature p {
            font-style: italic;
            text-align: right;
        }

        .footer {
            text-align: center; /* Centra el contenido del footer */
            margin-top: 0px; /* Ajusta el margen superior para dar espacio */
        }

        .footer2 {
            text-align: center; /* Centra el contenido del footer */
            margin-top: 100px; /* Ajusta el margen superior para dar espacio */
        }

        .footer3 {
            text-align: center; /* Centra el contenido del footer */
            margin-top: 280px; /* Ajusta el margen superior para dar espacio */
        }

        #imgcertificado{
            margin-left: 600px;
        }

        .container{
            height: 450px;
        }

    </style>
</head>

<body>
    @foreach ($contractors as $contract)
    @endforeach

    <div class="header">
        <img src="{{ $image }}" alt="Sena Logo" width="70px" height="70px" />
        <h3>EL SUSCRITO (A) SUBDIRECTOR (A) DEL CENTRO DE FORMACION AGROINDUSTRIAL DE LA
            REGIONAL HUILA DEL SERVICIO NACIONAL DE APRENDIZAJE SENA</h3>
        <br>
        <h3>HACE CONSTAR</h3>
        <br>
        <br>
        <p>Que la señora/señor {{ $contract->person->first_name}} {{$contract->person->first_last_name}}
            {{$contract->person->second_last_name}} indentificada con {{ $contract->person->document_type}} No.
            {{ $contract->person->document_number}} de Campoalegre (Huila) celebró con EL SERVICIO NACIONAL DE
            APRENDIZAJE SENA, los siguientes contratos de prestación de servicios personales regulados por la Ley
            80 de 1993 (Estatuto General de Contratación de la Administración Pública), modificada por la Ley 1150
            de 2007, Decreto 1082 de 2015 y sus demás Decretos o normas reglamentarias, como se describe a
            continuación:</p>
    </div>

    <div class="contract-info">
        <p><b>1. Número y Fecha del Contrato </b>: {{ $contract->contract_number}} del
            {{ $contract->contract_start_date}}</p>

        <p> <b>Objeto </b>: {{ $contract->contract_object}}</p>

        <p> <b>Fecha de Inicio </b>: {{ $contract->contract_start_date}}. </p>

        <p> <b>Plazo de Ejecución </b>: Desde la fecha de inicio hasta el
            {{ $contract->contract_end_date}}.</p>

        <p> <b>Termino de Ejecución </b>: {{ $duration->format('%m meses y %d días') }}.</p>

        <p> <b>Estado Actual del Contrato </b>: {{ $contract->state}}.</p>

        <p><b>Valor total del contrato</b>: El valor del contrato para todos los efectos legales y
            fiscales se fijó en la suma de {{ strtoupper($totalInWords) }}
            ({{ $contract->total_contract_value }}).</p>

        <p> <b>Forma de Pago </b>: Forma de Pago: Honorarios mensuales por valor de TRES MILLONES
            QUINIENTOS SESENTA Y UN MIL SETECIENTOS TREINTA Y DOS PESOS MCTE (3.561.732).</p>

            <p> <b>Obligaciones Específicas del Contrato :</b></p>
    </div>

    <footer class="footer">
        <img src="{{ $image1 }}" width="80px" height="150px" id="imgcertificado">
        <p>
            Ministerio de Trabajo
        </p>
        <p >
            <b>SERVICIO NACIONAL DE APRENDIZAJE</b>

        </p>
        <p>
            <b>Centro de Formación Agroindustrial</b>
        </p>
        <hr>
        <p>
            <b>Km 38 vía al sur de Neiva</b> - PBX (57 8) 8768374
        </p>
        <p>
            www.sena.edu.co - Línea gratuita nacional: 01 8000 9 10 270 GTH-F-131 V03 - Pági 1
        </p>
      </footer>

      <div class="header">
        <img src="{{ $image }}" alt="Sena Logo" width="70px" height="70px" />
        <br>
        <br>
        <div class="container">
        <p>
            {{ $contract->contract_obligations}}
        </p>
        </div>
    </div>
    <br>
    <footer class="footer2">
        <img src="{{ $image1 }}" width="80px" height="150px" id="imgcertificado">
        <p>
            Ministerio de Trabajo
        </p>
        <p >
            <b>SERVICIO NACIONAL DE APRENDIZAJE</b>

        </p>
        <p>
            <b>Centro de Formación Agroindustrial</b>
        </p>
        <hr>
        <p>
            <b>Km 38 vía al sur de Neiva</b> - PBX (57 8) 8768374
        </p>
        <p>
            www.sena.edu.co - Línea gratuita nacional: 01 8000 9 10 270 GTH-F-131 V03 - Pág 2
        </p>
      </footer>


      <div class="header">
        <img src="{{ $image }}" alt="Sena Logo" width="70px" height="70px" />
        <br>
        <br>
        <p>
            Se expide a solicitud de la interesada, de acuerdo con la revisión realizada y la información
            registrada el sistema, a los veintiocho (28) días del mes de julio de 2023.
        </p>
        <br>
        <br>
        <br>
        <h3>GLORIA MARITZA SÁNCHEZ ALARCÓN
            SUBDIRECTORA DE CENTRO (E)</h3>
        <br>
        <br>
        <p> Proyectó :  Zaray Leandra Rojas Cuellar</p>
        <p> Pasante Talento Humano</p>
        <br>
        <p> Revisó :  Erika Yasmín Puentes Lemus </p>
        <p> Cargo :  Coordinadora Grupo de Apoyo Administrativo </p>

    </div>
    <br>
    <footer class="footer3">
        <img src="{{ $image1 }}" width="80px" height="150px" id="imgcertificado">
        <p>
            Ministerio de Trabajo
        </p>
        <p >
            <b>SERVICIO NACIONAL DE APRENDIZAJE</b>

        </p>
        <p>
            <b>Centro de Formación Agroindustrial</b>
        </p>
        <hr>
        <p>
            <b>Km 38 vía al sur de Neiva</b> - PBX (57 8) 8768374
        </p>
        <p>
            www.sena.edu.co - Línea gratuita nacional: 01 8000 9 10 270 GTH-F-131 V03 - Pág 2
        </p>
      </footer>
      <script>
        // Código para numerar páginas
        var pageNum = 1;
        var topage = 3; // Aquí va el total de páginas

        document.getElementById("pageNum").innerHTML = pageNum;
        document.getElementById("topage").innerHTML = topage;
      </script>
</body>

</html>
