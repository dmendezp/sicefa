

 <!-- @foreach($asistencia as $a)

{{$a}}


@endforeach
 -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<table class="table" id="myTable">
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
                <div class="mb-3 round contenedor"><div cllas="hijo">{{$a->date}}</div></div>
                @endforeach
            </td>
            <td>
                @foreach($asistente->asistencias as $a)

                <!-- Default switch -->
                
                <label class="switchBtn">
                    
                    <input type="checkbox" data-id="{{ $a->pivot->id }}" name="asistencia" class="js-switch"
                        {{ $a->pivot->asistencia == 'si' ? 'checked' : '' }}>
                    <div class="slide round contenedor"><div class="hijo">Asistió</div></div>
                </label>
               
</
                @endforeach
            </td>
            </div>
        </tr>
        
    </tbody>



    <!--
        @foreach($asistente->asistencias as $asistencias) 

        {{$asistencias->date}} - {{$asistencias->pivot->asistencia}} - {{$asistencias->guardado}}<br>
        {{$asistencias}}
        @endforeach
       

-->

    @endforeach
</table>




<script>

        @if (Session::get('message'))
            $('html, body').animate({ /* Move the page to the previously selected configuration */
                scrollTop: $("#{{ Session::get('card') }}").offset().top
            }, 1000);
            /* Show the message */
            @if (Session::get('icon') == 'success')
                toastr.success("{{ Session::get('message') }}");
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
            }
        });
    });
});
</script>


<style>
.switchBtn {
    position: relative;
    display: inline-block;
    width: 96%;
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
  width: 50px;
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
    });

});
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>




