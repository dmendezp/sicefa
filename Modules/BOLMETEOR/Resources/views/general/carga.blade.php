@extends( Request::is('bolmeteor/graficas/carga') ? 'bolmeteor::layouts.master' : 'bolmeteor::layouts.admin')
@section('title','Home')
@section('breadcrumb')
<li class="breadcrumb-item active">
   <a href="{{ route('bolmeteor.estacion.index') }}"><i class="fas fa-home"></i> {{ __('Boletín Meteorológico') }}</a>
</li>
@endsection
@section('content')
<!-- Main content -->
<div class="content">
   {!! Form::open(['url' => route('bolmeteor.general.graficas.carga.guardar'), 'files' => 'true','enctype'=>'multipart/form-data']) !!}
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="card card-green card-outline shadow col-md-12 ">
            <div class="card-header">
               <h3 class="card-title">Filtro de Busqueda</h3>
            </div>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
               Upload Validation Error<br><br>
               <ul>
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
               <div class="col-md-12">
                  <label for="archivo" >Seleccione un archivo para cargar:</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-upload"></i>
                        </span>
                     </div>
                     {{ Form::input('file', 'archivo', @$_REQUEST['archivo'], ['id' => 'archivo', 'class' => 'form-control', 'required' => 'required']) }}
                  </div>
               </div>
               <div class="col-md-12">
                {!! Form::submit('Cargar',['class'=>'btn btn-warning mtop16']) !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   {!! Form::close() !!}
   <div class="container-fluid">
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
                  <table id="Climatable" class=" table-responsive table table-bordered yajra-datatable">
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
                           <th scope="col">actions</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
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
                  <input type="text" name="id" id="id"/>
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
                  <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
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
          $('#id').val(data.id);
          //$('#id').val(data.DT_RowIndex);
          $('#date_time').val();
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
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('bolmeteor.estacion.climaticdata') }}",
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex'},
                {"data": 'date_time', "name": 'date_time'},
                {"data": 'temperature', "name": 'temperature'},
                {"data": 'precipitation', "name": 'precipitation'},
                {"data": 'relative_humidity', "name": 'relative_humidity'},
                {"data": 'solar_radiation', "name": 'solar_radiation'},
                {"data": 'winds_direction', "name": 'winds_direction'},
                {"data": 'winds_peed', "name": 'winds_peed'},
                {
                    "data": 'action', 
                    "name": 'action', 
                    "orderable": true, 
                    "searchable": true,
                    "fixedHeader": true 
                }
            ],
            "dom": 'Bfrtip',
           "buttons": [
               'pdf'
           ]
        });
      
       $('.yajra-datatable tbody').on( 'click', '.btn-editar', function (e) {
          var data = table.row( $(this).parent().parent() ).data();
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
             "url": "{{ route('bolmeteor.estacion.climaticdata.update') }}",
             "type": "POST",
             "data": {
                 "_token": $("#csrf").val(),
                 "type": 1,
                 "id": id,
                 "person_id": 1,
                 "date_time": date_time,
                 "temperature": temperature,
                 "precipitation": precipitation,
                 "relative_humidity": relative_humidity,
                 "solar_radiation": solar_radiation,
                 "winds_direction": winds_direction,
                 "winds_peed": winds_peed
             },
             "cache": false,
             "success": function(dataResult){
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
                 "url": "{{ url('bolmeteor/climaticdata/delete/') }}" +"/" + id,  //Url por cambiar en subida a servidor
                 "type": 'POST',
                 "dataType": "JSON",
                 "data": {
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
</div>
@stop