@extends('bolmeteor::layouts.master')
@section('title','Home')
@section('breadcrumb')
<li class="breadcrumb-item active">
   <a href="{{ route('bolmeteor.estacion.index') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a>
</li>
@endsection
@section('content')
<!-- Main content -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6 d-flex">
            <div class="card card-green card-outline shadow">
               <div class="card-header text-muted border-bottom-0">
               </div>
               <div class="card-body pt-0">
                  <div class="row">
                     <div class="col-12">
                        <h1 class="text-bold lead text-center">Estación metereológica</h1>
                        <p class="text-muted text-md-justify">
                           Desde el mes de marzo del 2017 el Centro de Formación Agroindustrial “La Angostura”
                           de la Regional Huila, pone a disposición de la comunidad educativa del SENA y del
                           sector productivo de la región, la información de la estación meteorológica ubicada
                           dentro de las instalaciones del Centro de Formación.
                        </p>
                        <p class="text-muted text-md-justify">
                           La información se registra en una estación meteorológica automática marca WatchDog
                           2900ET de los siguientes elementos del clima: Precipitación, Temperatura, Humedad
                           relativa, velocidad y dirección del viento, Radiación solar (W/m2
                           ). La periodicidad de la
                           toma de información es de 10 minutos. La información que se presentará es el
                           acumulado de precipitación, humedad relativa, velocidad del viento y de radiación solar.
                        </p>
                        <div id="example2"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 d-flex">
            <div class="card card-green card-outline shadow">
               <!-- /.card-header -->
               <div class="card-body">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <img class="d-block w-100" src="{{ asset('bolmeteor/images/B1.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                           <img class="d-block w-100" src="{{ asset('bolmeteor/images/B2.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                           <img class="d-block w-100" src="{{ asset('bolmeteor/images/B3.jpg') }}" alt="Third slide">
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.card-body -->
      <div class="row">
         <script>  
            Highcharts.chart('container', {
            
                title: {
                    text: 'Solar Employment Growth by Sector, 2010-2016'
                },
            
                subtitle: {
                    text: 'Source: thesolarfoundation.com'
                },
            
                yAxis: {
                    title: {
                        text: 'Number of Employees'
                    }
                },
            
                xAxis: {
                    accessibility: {
                        rangeDescription: 'Range: 2010 to 2017'
                    }
                },
            
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
            
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 2005
                    }
                },
            
                series: [{
                    name: 'Temperatura',
                    data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
                }],
            
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            
            });
            
         </script>   
         <!-- /.row -->
         <div class="row">
            <div class="col-md-12">
               <div class="card card-green card-outline shadow">
                  <div class="card-header">
                     <h3 class="card-title">
                        Datos Climáticos
                     </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-header card-green text-muted border-bottom-0">
                  </div>
                  <div class="card-body col-md-12">
                     <table class="table table-bordered yajra-datatable">
                        <thead class=" thead">
                           <tr class="bg-success" >
                              <th scope="col">#</th>
                              <th scope="col">date</th>
                              <th scope="col">temperature</th>
                              <th scope="col">precipitation</th>
                              <th scope="col">relative humidity</th>
                              <th scope="col">solar radiation</th>
                              <th scope="col">winds direction</th>
                              <th scope="col">winds peed</th>
                              <!--<th scope="col">editar</th>-->
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-header -->
         <!-- /.card-body -->
      </div>
   </div>
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
<!-- /.content -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form>
         <div class="modal-body">
              <input type="hidden" name="id" id="id"/>
              <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="date_time">Date time</label>
                     <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="temperature">Temperature</label>
                     <input type="decimal" class="form-control" id="temperature" name="temperature" required>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="temperature">Precipitation</label>
                     <input type="decimal" class="form-control" id="precipitation" name="precipitation" required>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="temperature">Relative Humidity</label>
                     <input type="decimal" class="form-control" id="relative_humidity" name="relative_humidity" required>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="temperature">Solar Radiation</label>
                     <input type="decimal" class="form-control" id="solar_radiation" name="solar_radiation" required>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="temperature">Winds Direction</label>
                     <input type="decimal" class="form-control" id="winds_direction" name="winds_direction" required>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="temperature">Wind Speed</label>
                     <input type="decimal" class="form-control" id="winds_peed" name="winds_peed" required>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-guardar">Guardar</button>
         </div>
         </form>
      </div>
   </div>
</div>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript">

   $(function () {

     function llenarModal(data){
       $('#id').val(data.DT_RowIndex);
       $('#date_time').val("2013-3-18T13:00");
       document.getElementById("date_time").value = moment(data.date_time).format('YYYY-MM-DDThh:mm:ss.SSS');
       $('#temperature').val(data.temperature);
       $('#precipitation').val(data.precipitation);
       $('#relative_humidity').val(data.relative_humidity);
       $('#solar_radiation').val(data.solar_radiation);
       $('#winds_direction').val(data.winds_direction);
       $('#winds_peed').val(data.winds_peed);
    }

    function limpiarModal(){
      $('#id')[0].reset();
       $('#date_time')[0].reset();
       $('#temperature')[0].reset();
       $('#precipitation')[0].reset();
       $('#relative_humidity')[0].reset();
       $('#solar_radiation')[0].reset();
       $('#winds_direction')[0].reset();
       $('#winds_peed')[0].reset();
    }
    
     var table = $('.yajra-datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ route('bolmeteor.estacion.climaticdata') }}",
         columns: [
             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
             {data: 'date_time', name: 'date_time'},
             {data: 'temperature', name: 'temperature'},
             {data: 'precipitation', name: 'precipitation'},
             {data: 'relative_humidity', name: 'relative_humidity'},
             {data: 'solar_radiation', name: 'solar_radiation'},
             {data: 'winds_direction', name: 'winds_direction'},
             {data: 'winds_peed', name: 'winds_peed'}/*,
             {
                 data: 'action', 
                 name: 'action', 
                 orderable: true, 
                 searchable: true
             }*/
         ]/*,
         dom: 'Bfrtip',
        buttons: [
            'pdf'
        ]*/
     });
   
    $('.yajra-datatable tbody').on( 'click', '.btn-editar', function (e) {
        data = table.row( $(this).parent().parent() ).data();
        llenarModal(data);
        $('#exampleModal').modal('show');
        $('#exampleModal').on('shown.bs.modal',function(event){
          
        }).on('hidden.bs.modal', function (e) {
          limpiarModal();          
        });
    });

    $(".btn-guardar").click( function (e) {
      e.preventDefault();
      // Guardar formulario
      var id = $('#id').val();
      var date_time = $('#date_time').val();
      var temperature = $('#temperature').val();
      var precipitation = $('#precipitation').val();
      var relative_humidity = $('#relative_humidity').val();
      var solar_radiation = $('#solar_radiation').val();
      var winds_direction = $('#winds_direction').val();
      var winds_peed = $('#winds_peed').val();
      $.ajax({
          url: "{{ route('bolmeteor.estacion.climaticdata.update') }}",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              type: 1,
              id: id,
              date_time: date_time,
              temperature: temperature,
              precipitation: precipitation,
              relative_humidity: relative_humidity,
              solar_radiation: solar_radiation,
              winds_direction: winds_direction,
              winds_peed: winds_peed
          },
          cache: false,
          success: function(dataResult){
            $('#exampleModal').modal('hide');
            table.draw('page');         
            alert('El registro se guardó correctamente');   
          }
      });
    });

    
   
    $('.yajra-datatable tbody').on( 'click', '.btn-eliminar', function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        if(confirm("¿Desea eliminar el registro?")){
          $.ajax(
          {
              url: 'http://sicefa.test/bolmeteor/admin/' + id,
              type: 'POST',
              dataType: "JSON",
              data: {
                  "id": id,
                  "_method": 'DELETE',
                  "_token": token,
              },
              success: function ()
              {
                  alert('¡Registro eliminado!');
                  table.draw('page');
              }
          });
        }
   
    });
     
   });
</script>
@stop