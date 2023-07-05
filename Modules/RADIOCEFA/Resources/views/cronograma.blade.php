@extends('radiocefa::layouts.master')

@section('styles')

@endsection

 @section('textHero')
  <h1>Cronograma</h1>
  <h2><p>Programate en tu dia con nuestras secciones</p></h2>
@endsection
@include('radiocefa::layouts/partials/hero')

@include('radiocefa::layouts/partials/navbar')

@section('content')
<div class="m-4">
  <table id="tabla" class="table table-bordered text-center">
    <tr id="fecha">
      <th>Hora</th>

      
    </tr>
    {{-- aqui se debe de crear un ciclo para que se repita la tabla --}}
    
  </table>  
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    fetchParrilla();
  });
  const INITIAL_VALUES = [
    {
      "id": 1,
      "horary": "2023-04-14 07:15:35",
      "Day": "2023-04-11",      
      "title": "Radiocefa",
      "descripcion": "Musica para ti",
    },
    {
      "id": 2,
      "horary": "2023-04-14 08:15:35",
      "Day": "2023-04-11",      
      "title": "Radiocefa",
      "descripcion": "Musica para ti",
    }
  ];
  /**
   * Obtener la parrilla de la semana actual
   */
  const fetchParrilla = () => {
    let baseUrl = window.location.origin;
    fetch(baseUrl + '/radiocefa/parrilla')
    .then(response => response.json())
    .then(data => {
      console.log(data);
      renderParrilla(data);
    }).catch(error => {
      console.log(error);
      renderParrilla(INITIAL_VALUES);
    });
  }
  // Obtener la fecha actual
  var fechaActual = new Date();
  let DIAS = [];
  // Calcular la fecha de inicio y fin de la semana actual
  var diaSemanaActual = fechaActual.getDay();
  var inicioSemanaActual = new Date(fechaActual);
  inicioSemanaActual.setDate(fechaActual.getDate() - diaSemanaActual + 1); // Restar el día de la semana actual para obtener el lunes
  var finSemanaActual = new Date(inicioSemanaActual);
  finSemanaActual.setDate(inicioSemanaActual.getDate() + 4); // Sumar 4 días para obtener el viernes
  // Obtenemos la cabecera
  var filaCabecera = document.getElementById('fecha');
  // Iterar sobre los días de la semana
  for (var i = 0; i < 5; i++) {
    var celda = document.createElement('td');
    var fechaCelda = new Date(inicioSemanaActual);
    fechaCelda.setDate(inicioSemanaActual.getDate() + i); // Sumar el índice del día para obtener la fecha correspondiente
    // Establecer el contenido de la celda con la fecha en el formato deseado
    var diaSemana = fechaCelda.toLocaleString('es-ES', { weekday: 'short' });
    var diaMes = fechaCelda.getDate();
    var mes = fechaCelda.toLocaleString('es-ES', { month: 'short' });
    celda.textContent = diaSemana + ' ' + diaMes + ' ' + mes;
    // Agregar la celda a la fila de la cabecera
    filaCabecera.appendChild(celda);
    DIAS.push(diaMes);
    console.log(DIAS);
  }
  const renderParrilla = (parrilla) => {
    // Obtenemos la tabla
    var tabla = document.getElementById('tabla');
    // Iterar sobre los programas
    for (var i = 0; i < parrilla.length; i++) {
      var programa = parrilla[i];
      // Crear una fila para el programa
      var fila = document.createElement('tr');
      fila.setAttribute('id', 'programa-item');
      // Crear una celda para la hora
      var celdaHora = document.createElement('td');
      celdaHora.setAttribute('id', 'programa-hora');
      // Establecer el contenido de la celda con la hora en el formato deseado
      let horasP = programa.horary.slice(11, 13);
      let minutosP = programa.horary.slice(14, 16);
      celdaHora.textContent = horasP + ':' + minutosP;
      fila.appendChild(celdaHora);
      // Iterar sobre los días de la semana
      for (var j = 0; j < 5; j++) {
        // si el dia de la semana es igual al dia de la semana del programa
        var diaPrograma = parseInt(programa.Day.split('-')[2]);
        if (diaPrograma == DIAS[j]) {
          // Crear una celda para el programa
          var celdaPrograma = document.createElement('td');
          celdaPrograma.setAttribute('class', 'bg-dark');
          // Establecer el contenido de la celda con el título y la descripción del programa
          var tituloPrograma = document.createElement('div');
          tituloPrograma.setAttribute('id', 'programa-title');
          tituloPrograma.setAttribute('class', 'text-white');
          tituloPrograma.innerHTML = '<B><h3>' + programa.title + '</h3></B><p>' + programa.Day + '</p>';
          celdaPrograma.appendChild(tituloPrograma);
          fila.appendChild(celdaPrograma);
        } else {
          // Crear una celda vacía
          var celdaVacia = document.createElement('td');
          fila.appendChild(celdaVacia);
        }
      }
      // Agregar la fila a la tabla
      tabla.appendChild(fila);
    }
  }
  
  
</script>
@include('radiocefa::layouts/partials/script')

@include('radiocefa::layouts/partials/footer')

@endsection