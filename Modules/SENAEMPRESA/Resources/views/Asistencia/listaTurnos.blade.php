@extends('senaempresa::layouts.master')

@section('content')



<!--{{$asistencias}}<br> -->




<div class="card card-outline card-primary me-1 ms-1">
    <div class="card-header">
        <h3 class="card-title">Asignar Turno</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>

        <div class="col-12">
            <select class="form-control" name="course_id" id="course_" class="" required>
                <option value="">Seleccione...</option>
                @foreach($courses as $cursos)
                <option value="{{$cursos->id}}">{{$cursos->code}}-{{$cursos->Program->name}}</option>
                @endforeach
            </select>
            <div id="divAprendices">

            </div>
        </div>


    </div>

    <div class="card-body">

        <table class="table " id="Table_Turnos">
            <thead class="thead">
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Programa</th>
                    <th>Ficha</th>
                </tr>
            </thead>
            <tbody>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @foreach($asistencias as $asistencia)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>
                        <div class="row">
                            <form action="{{route('updateTurno')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $asistencia->id }}">
                                <input type="date" name="date" id="" value="{{$asistencia->date}}">
                                <button type="submit" class="btn btn-outline-success btn-sm" name="" id=""
                                    placeholder="">
                                    <i class="far fa-edit"></i>
                                </button>
                            </form>
                            <form action="{{ route ('attendance.turnDelete')}}" style="margin-left: 4%"
                                method="get" id="formEliminar">
                                <input type="hidden" value="{{$asistencia->id}}" name="id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                        class="fas fa-trash"></i></button>

                            </form>
                        </div>



                    </td>
                    <td>{{$asistencia->apprentices->first()->Course->Program->name}}</td>
                    <td>{{$asistencia->apprentices->first()->CodeCurso}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>





@endsection

@section('dataTables')
<script type="text/javascript">
$(document).ready(function() {
    $('#Table_Turnos').DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
@endsection

@section('scripts')

<!-- ajax para traer el id de los aprendices -->
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on("change", "#course_",
function() { //change se utiliza para saber si hay cambios en el section "click" se puede utilizar cuando se da click en un boton
    //alert($(this).val());  //la función de val me trae el id de los cursos para traer todos los datos relacionados y este es un alert para mostrar el id; también se puede colocar alert('mensaje'); para saber si entró a la función.


    //inicio del ajax

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            method: "get",
            url: 'http://expo.test/sicefa/public/senaempresa/TurnoRutinario/Guardar/' + $(this).val(),
            data: {}
        })
        .done(function(html) {
            $("#divAprendices").html(html);
        })

    //fin del ajax
});
</script>

<!-- select2 -->
<script>
$(document).ready(function() {
    $('#course_').select2();

});

//condicional para mensaje de sweetalert2 

@if($messages = Session::get('message_result'))


Swal.fire({
    position: 'center', //'top-start','top-end','top-center', 'center-start','center','center-end','bottom','bottom-start','bottom-start'

    @if(Session::get('icon') == 'success')
    icon: 'success',
    @elseif(Session::get('icon') == 'error')
    icon: 'error',
    @endif
    title: '{{$messages}}',
    showConfirmButton: false,
    timer: 2400
});


@endif
</script>

<!-- script para sweet alert de confirmación delete -->
<script>
            'use strict';
            //debemos crear la clase formEliminar dentro del form del boton borrar
            //recordar que cada registro a eliminar esta contenido en un form
            var forms = document.querySelectorAll('#formEliminar')
            
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault() //esta función impide que se ejecute el submite del delete
                    event.stopPropagation()
                    Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                   /*  Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'); */
                                    this.submit(); //este submit se usa para realizar la acción luego de aceptar

                            }
                             })
                }, false)
                })

            </script>

@endsection