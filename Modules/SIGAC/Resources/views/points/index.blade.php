@extends('sigac::layouts.master')

@section('content')


<div class="container my-5">
    <form class="form-registro" method="get" id="registerUserForm" action="{{ route('sigac::points.points.store') }}">


        @csrf

        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                Formulario
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="date">Fecha

                    </label>
                    <input type="date" class="form-control" id="date" name="date" required>
                    <small class="form-text text-muted">Ingrese la fecha en formato dd/mm/aaaa.</small>
                </div>
                 <div class="form-group">
                    <label for="program">Programa:

                    </label>
                    <select name="course" id="course" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->CodeName }}</option>
                        @endforeach
                    </select>
                </div>

                <select name="apprentices[]" id="apprentices" class="form-control" multiple>
                   <option value="">Seleccione--</option>
                </select>

                <div class="form-group">
                    <label for="quantity">Cantidad

                    </label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                    <small class="form-text text-muted">Ingrese la cantidad como un número entero.</small>
                </div>

                <div class="form-group">
                    <label for="theme">Tema

                    </label>
                    <input type="text" class="form-control" id="theme" name="theme" required>
                    <small class="form-text text-muted">Ingrese el tema del formulario.</small>
                </div>

                <div class="form-group">
                    <label for="state">Estado</label>
                    <select class="form-control" id="state" name="state" required>
                        <option value="">Seleccione un estado</option>
                        <option value="positive">Positivo</option>
                        <option value="negative">Negativo</option>
                    </select>
                    <small class="form-text text-muted">Seleccione el estado del formulario.</small>
                </div>


                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')

<script>
    $('#course').change(function() {
        var courseId = $(this).val();

        $.ajax({
            url: '{{ route('sigac::points.getapprentices') }}',
            data: { course_id: courseId },
            type: 'GET',
            success: function(response) {
                $('#apprentices').empty();
                $.each(response, function(index, apprentice) {
                    $('#apprentices').append('<option value="">'+apprentice.person.first_name+'</option>');
                });
            }
        });
    });




</script>
@endsection
