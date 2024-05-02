@extends('senaempresa::layouts.master')

@section('content')



<!--{{$asistencias}}<br> -->




<div class="card card-outline card-primary me-1 ms-1">
    <div class="card-header">
        <h3 class="card-title" style="margin-botton:2%">Asignar Turno</h3>
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
                    <th>Fecha y Hora inicio / Finalización</th>
                    <th>Programa</th>
                    <th>Ficha</th>
                    <th>Asignación Tarea Aprendiz</th>

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

                            <div class="col-10">
                                <form action="{{route('updateTurno')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $asistencia->id }}">
                                    <input type="datetime-local" name="start" id="start" value="{{$asistencia->start}}"
                                        style="width:45%" min="{{$fechaActual}}" required>
                                    <input type="datetime-local" name="end" id="end" value="{{$asistencia->end}}"
                                        style="width:45%" min="{{$fechaActual}}" required>

                                    <button type="submit" class="btn btn-outline-success btn-sm" name="" id=""
                                        placeholder="">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="col-2">
                                <form action="{{ route ('attendance.turnDelete')}}" style="margin-left: 4%" method="get"
                                    id="formEliminar">
                                    <input type="hidden" value="{{$asistencia->id}}" name="id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>

                                </form>
                            </div>






                    </td>
                    <td>{{$asistencia->apprentices->first()->Course->Program->name}}</td>
                    <td>{{$asistencia->apprentices->first()->Course->code}}-{{$asistencia->apprentices->first()->pivot->id}}</td>
                    <td>
                        <div class="desplegable btn thead text-light"><span>
                                <h6><b>Asignación de Tareas</b></h6><i class="nav-icon fas fa-clipboard-list"></i>
                            </span>
                            <div class="contenido">

                                <div class="container" style="margin-top:5%">
                                    <div class="row">
                                        <table class="Table ms-3" style="margin-left:3%" id="Table">
                                            <thead class="thead">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Activida a desarrollar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($asistencia->apprentices as $apprentice)



                                                <tr>
                                                    <td>{{$apprentice->person->FullName}}<!-- -{{$apprentice->pivot->id}}-{{$apprentice->pivot->work_id}} --></td>

                                                    <td>
                                                        <select name="activity" class="works js-switch2"  data-id="{{$apprentice->pivot->id}}">
                                                            <option>Seleccionar...</option>
                                                            @foreach($works as $work)
                                                            @if($work->id === $apprentice->pivot->work_id)
                                                            <option value="{{$work->id}}" selected>{{$work->DescriptionWork}}</option>
                                                            @else
                                                            <option value="{{$work->id}}">{{$work->DescriptionWork}}</option>    
                                                            @endif
                                                            @endforeach

                                                        </select>
                                                        <div id="divResult">

                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </td>
                </tr>

                

                @endforeach
            </tbody>
        </table>

    </div>

</div>



<!-- Div desplegable -->
<!-- <div>
    <div class="desplegable"><span>Click</span>
        <div class="contenido">



        </div>
    </div>



    <div class="desplegable"><span>Click</span>
        <div class="contenido">
            <ul class="listaPermisos">
                <li>
                    <div class="triCheckbox" data-estado="-1"><span>General</span></div>
                    <ul>
                        <li>
                            <div class="triCheckbox" data-estado="-1"><span>Notificaciones</span></div>
                        </li>
                        <li>
                            <div class="triCheckbox" data-estado="-1"><span>Contactar</span></div>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="listaPermisos">
                <li>
                    <div class="triCheckbox" data-estado="-1"><span>Sin Hijos</span></div>
                </li>
            </ul>
            <ul class="listaPermisos">
                <li>
                    <div class="triCheckbox" data-estado="-1"><span>Peticiones</span></div>
                    <ul>
                        <li>
                            <div class="triCheckbox" data-estado="-1"><span>Nueva Peticion</span></div>
                        </li>
                        <li>
                            <div class="triCheckbox" data-estado="-1"><span>Mis Peticiones</span></div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div> -->


<!-- 
Estilos del menu desplegable -->
<style>
.contenido {
    display: none;
}

/*.PruebaSprite{
  padding-left:19px;
  background: transparent url("  https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -27px;
}

.PruebaSprite-fin{
  padding-left:19px;
  background: transparent url("  https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -5px;
}*/

.listaPermisos {
    display: inline-block;
}

.listaPermisos,
.listaPermisos ul {
    list-style-type: none;
    margin-left: 0;
    padding-left: 30px;
}

.listaPermisos>li>ul>li div {
    padding-left: 19px;
}

/*Segundo Nivel */
.listaPermisos>li>ul>li:not(:last-child)>div {
    background: transparent url("https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -27px;
}

/*Segundo Nivel */
.listaPermisos>li>ul>li:last-child>div {
    background: transparent url("https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -5px;
}


/*Tercer nivel*/
.listaPermisos>li>ul>li:not(:last-child)>ul {
    background: transparent url("https://sites.google.com/a/bbva.com/gdd_app/treeBranch.png") repeat-y scroll -8px -44px;
}

/*Tercer nivel y siguientes*/
.listaPermisos>li>ul>li>ul>li:last-child div {
    background: transparent url("https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -5px;
}

/*Tercer nivel y siguientes*/
.listaPermisos>li>ul>li>ul>li:not(:last-child) div {
    background: transparent url("https://sites.google.com/a/bbva.com/gdd_app/treeview.png") no-repeat scroll -3px -5px;
}


.triCheckbox {
    display: inline-block;
    cursor: pointer;
    -webkit-touch-callout: none;
    /*Todo esto es para que no se pueda seleccionar el texto */
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-right: 5px;
    margin-bottom: 2px;
}

.triCheckbox[data-estado="-1"]>span {
    background-color: red;
    /*  text-decoration: line-through;*/
}

.triCheckbox[data-estado="0"]>span {
    background-color: blue;
}

.triCheckbox[data-estado="1"]>span {
    background-color: green;
}
</style>


@endsection

@section('dataTables')
<script type="text/javascript">
$(document).ready(function() {
    $('#Table_Turnos').DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});

$(document).ready(function() {
    $('#Table').DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
@endsection

@section('scripts')

<!-- ajax para traer el id de los aprendices -->
<script>
$(document).on("change", "#course_",
    function() { //change se utiliza para saber si hay cambios en el section "click" se puede utilizar cuando se da click en un boton
        /* alert($(this).val()); */  //la función de val me trae el id de los cursos para traer todos los datos relacionados y este es un alert para mostrar el id; también se puede colocar alert('mensaje'); para saber si entró a la función.


        //inicio del ajax

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                method: "get",
                url: '{{url("")}}/senaempresa/TurnoRutinario/Guardar/' + $(this).val(),
                data: {}
            })
            .done(function(html) {
                $("#divAprendices").html(html);
            })

        //fin del ajax
    });
</script>


<!-- Ajax para saignar actividades por unidad para el turno -->
<script>
$(document).on("change", "#select_work",

    function() {
        /* alert($(this).val()); */
        //inicio del ajax

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                method: "get",
                url: '{{url("")}}/senaempresa/ListaTurnos/workAsign/' + $(this).val(),
                data: {}
            })
            .done(function(html) {
                $("#divResult").html(html);
            })

        //fin del ajax

    });
</script>



<script>
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
                /* alert(data.message); */
                Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500})
            }
        });
    });
});
</script>





<!-- select2 -->
<script>
$(document).ready(function() {
    $('#course_').select2();

});

$(document).ready(function() {
    $('.works').select2();

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
    timer: 3300
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
    .forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault() //esta función impide que se ejecute el submite del delete
            event.stopPropagation()
            Swal.fire({
                title: 'Esta seguro?',
                text: "Es un proceso inreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminarlo!'
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


<!-- Este es el script de desplegable de secciones  -->
<script>
$(".desplegable > span").click(function() {
    $(this).next(".contenido").toggle(500);
});

$(".triCheckbox").click(function() {
    var estado = Number($(this).attr("data-estado"));
    if (estado == 1)
        estado = -2;

    estado += 1;
    //Comprobar si estamos en padre o en hijo.
    var liPadre = $(this).parent("li");

    if (liPadre.parents('ul').length >= 2) {
        //Entonces el elemento es un hijo   
        //Si estamos en el hijo dando permisos, darselos al padre.
        var permisoPadre = liPadre.parent("ul").parent("li").children(".triCheckbox");
        if (estado != -1 && permisoPadre.attr("data-estado") == -1)
            liPadre.parent("ul").parent("li").children(".triCheckbox").attr("data-estado", 0);

    } else {
        //Si estamos quitando permisos, quitar a los hijos
        if (estado == -1)
            liPadre.find(".triCheckbox").attr("data-estado", estado);
    }
    $(this).attr("data-estado", estado);
});
</script>

@endsection