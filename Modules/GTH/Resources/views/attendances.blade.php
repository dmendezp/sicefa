@extends('gth::layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">{{ trans('gth::menu.Attendance View') }}</h1>
            <p class="lead">{{ trans('gth::menu.Welcome to the attendance page. Here you can view and manage employee attendance.') }}</p>
            <a class="btn btn-success btn-sm mx-auto" href="{{ route('gth.registerattendance.registerattendance.index') }}">{{ trans('gth::menu.Add Attendance') }}</a>
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    {{ trans('gth::menu.List of Attendance') }}
                </div>

        <!-- Filtro de estado de registro -->
        <div class="form-group">
            {!! Form::label('programselect', 'Seleccionar Programa') !!}
            {!! Form::select('programselect', $selectprogram, old('programselect'), ['class' => 'form-control', 'placeholder' => 'Seleccionar programa','id' => 'program', 'required']) !!}
        </div>
            </div>
        </div>
    </div>
    <div id="result">

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#program').change(function() {
        var courseid = $(this).val();

        // Realizar una solicitud AJAX para obtener los resultados de labores filtrados por cultivo
        $.ajax({
            type: 'POST',
            url: "{{ route('cefa.attendance.search') }}",
            data: {
                _token: "{{ csrf_token() }}",
                courseid: courseid
            },
            success: function(data) {
                // Actualizar el contenedor con los resultados de labores filtrados
                $('#result').html(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>
@endsection
