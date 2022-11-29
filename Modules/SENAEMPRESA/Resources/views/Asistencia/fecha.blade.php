<!--

 @foreach($asistencia as $a)

{{$a}}


@endforeach

-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

            <td>
                @foreach($asistente->asistencias as $a)
                <div class="mb-3 me-2">{{$a->date}}</div>
                @endforeach
            </td>
            <td>
                @foreach($asistente->asistencias as $a)
                <!-- <div class="mb-3 me-2"><input data-onstyle="success" data-offstyle="danger" data-on="si" data-off="no"
                        class="toggle-class " type="checkbox" name="asistencia" data-id="{{$a->pivot->id}}"></div> -->
                <!-- Default switch -->
               
                <label class="switchBtn">
                    
                    <input type="checkbox" data-id="{{ $a->pivot->id }}" name="asistencia" class="js-switch"
                        {{ $a->pivot->asistencia == 'si' ? 'checked' : '' }}>
                    <div class="slide round">Asistió</div>
                </label><br>

                <!-- <label class="switchBtn">
                        <input type="checkbox">
                        <div class="slide round">Asistió</div>
                    </label> -->
                @endforeach
            </td>



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
$(document).ready(function(){
    $('.js-switch').change(function () {
        let asistencia = $(this).prop('checked') === true ? 'si' : 'no';
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateAttendance') }}',
            data: {'asistencia': asistencia, 'id': userId},
            success: function (data) {
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
    width: 110px;
    height: 34px;
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
    width: 26%;
    left: 68%;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}


input:checked+.slide {
    background-color: #237286;
    padding-left: 40px;
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
    border-radius: 34px;
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