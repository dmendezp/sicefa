
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<!-- DataTables  & Plugins -->
{{--//estos datos se sacaron de public/libs/AdminLTE/tables/data.html--}}
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- SweetAlert2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.css')}}">

<!-- Select 2-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <!--  {{-- Sweatalert and toast --}} -->
 <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

<!-- {{-- Sweatalert and toast --}} -->
<script src="{{ asset('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<!-- {{$asistencia1}} -->



    
  
    
    
    
     



<table class="table" id="myTable">

<!-- Div para mostrar mensaje de la actualización de tareas -->
<div id="divResult" class = "sticky-top" style="float: right">

</div>
<!-- fin del div -->
    <thead class="bg-primary thead">
        <tr>
            <th colspan="5">
              
                Información del Turno Rutinario <br>
                
           
                <small>Ficha y Programa: </small>{{$asistencia1->first()->Asistencia->title}} <br>
                <small>Inicio: </small><label for="">{{$asistencia1->first()->Asistencia->start}}</label> ---
                <small>Fin: </small><label for="">{{$asistencia1->first()->Asistencia->end}}</label>
                
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Tarea</th>
            <th>Asistencia si/no</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($asistencia1 as $turnos)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td scope="row">{{$turnos->Apprentice->apprenticeFullName}}</td>
            <td>{{$turnos->Apprentice->apprentice_status}}</td>
            <td>
                <select name="activity" class="rounded form-control js-switch2" id="" data-id="{{ $turnos->id }}" >
                <option value="">Seleccione...</option>
                @foreach($works as $work)
                @if($work->id == $turnos->work_id)
                <option value="{{$work->id}}" selected >{{$work->DescriptionWork}}</option>
                @else
                <option value="{{$work->id}}">{{$work->DescriptionWork}}</option>
                @endif
                
                @endforeach
                </select>
                
                </td>
            <td>
                <!-- Default switch -->
                
                 <label class="switchBtn">
                    
                    <input type="checkbox" data-id="{{ $turnos->id }}" name="asistencia" class="js-switch"
                        {{ $turnos->asistencia == 'si' ? 'checked' : '' }}>
                    <div class="slide round contenedor"><div class="hijo">Asistió</div></div>
                </label>

            </td>
            
        </tr>
    @endforeach 
    </tbody>
</table>



<!-- TABLA QUE ESTABA INICIALMENTE UTILIZANDO EL ID DEL CURSO Y TRAYENDO LOS APRENDICES CON LA RELACION DE MUCHOS A MUCHOS -->
<!-- <table class="table" id="myTable">
    <thead class="bg-primary thead">
        <tr>
            <th>Nombre</th>
            <th>Tecnologo</th>
            <th>Ficha</th>
            <th>Fecha</th>
            <th>Asistencia</th>


        </tr>
    </thead>
    @foreach($asistencia as $asistente)

    <tbody>
        
        <tr>
            <td scope="row">{{$asistente->Person->first_name}} {{$asistente->Person->first_last_name}}</td>
            <td>{{$asistente->Course->Program->name}}</td>
            <td>{{$asistente->Course->code}}</td>
            <div class="form-group  ">
            <td>
                @foreach($asistente->asistencias as $a)
                <div class="mb-3 round contenedor"><div cllas="hijo">{{$a->start}}</div></div>
                <div class="mb-3 round contenedor"><div cllas="hijo">{{$a->end}}</div></div>
                @endforeach
            </td>
            <td>
                @foreach($asistente->asistencias as $a) -->

                <!-- Default switch -->
                
              <!--   <label class="switchBtn">
                    
                    <input type="checkbox" data-id="{{ $a->pivot->id }}" name="asistencia" class="js-switch"
                        {{ $a->pivot->asistencia == 'si' ? 'checked' : '' }}>
                    <div class="slide round contenedor"><div class="hijo">Asistió</div></div>
                </label>
               

                @endforeach
            </td>
            </div>
        </tr>
        
    </tbody>
 


    
        @foreach($asistente->asistencias as $asistencias) 

        {{$asistencias->date}} - {{$asistencias->pivot->asistencia}} - {{$asistencias->guardado}}<br>
        {{$asistencias}}
        @endforeach
       



    @endforeach
</table>
 -->



<script>

        @if (Session::get('message'))
            $('html, body').animate({ /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.error("{{ Session::get('message') }}");
            @elseif (Session::get('icon')=='error')
                toastr.error("{{ Session::get('message') }}");
            @endif
        @endif




$(document).ready(function() {
    $('.js-switch').change(function() {
        let asistencia = $(this).prop('checked') === true ? 'si' : 'no';
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateAttendance') }}',
            data: {
                'asistencia': asistencia,
                'id': userId
            },
            success: function(data) {
                console.log(data.message);

                /* Swal.fire({
                position: 'top-end',
                icon: data.icon,
                title: '',
                showConfirmButton: false,
                timer: 800
                }) */

                if (data.icon == 'success'){
                toastr.success(data.message);
                }else if(data.icon =='error'){
                    toastr.error(data.message);
                }
          
            }
        });
    });
});




$(document).ready(function() {
    $('.js-switch2').change(function() {
        let work = $(this).val();
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('workAsign') }}',
            data: {
                'work': work,
                'id': userId
            },
            success: function(data) {
                /* console.log(data.message); */
                Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
                })
            }
        });
    });
});
</script>


<style>

.swal-wide{
    width:50px !important;
}



.switchBtn {
    position: relative;
    display: inline-block;
    width: 60%;
    height: 25px;
}

.switchBtn input {
    display: none;
}

.slide {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    padding: 8px;
    color: #fff;
}

.slide:before {
    position: absolute;
    content: "";
    height: 76%;
    width: 20%;
    left: 68%;
    bottom: 10%;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}


input:checked+.slide {
    background-color: #237286;
    padding-left: 35%;
}

input:focus+.slide {
    box-shadow: 0 0 1px #01aeed;
}

input:checked+.slide:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    left: -20px;
}

.slide.round {
    border-radius: 44px;
}

.contenedor {
  ...
  position: relative;
}

.hijo {
  width: 60px;
  height: 50px;
  /* background-color: red; */
  /* centrar vertical y horizontalmente */
  
  top: 50%;
  left: 50%;
  margin: -8px 0 0 -0px; /* aplicar a top y al margen izquierdo un valor negativo para completar el centrado del elemento hijo */
}



.slide.round:before {
    border-radius: 50%;
}
</style>



<script>
$(function() {
    $("#myTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        language: {
        "search": "Buscar:",
        "Show": "Mostrar",
        "entries": "Registros",
        }
    });

});
</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>




