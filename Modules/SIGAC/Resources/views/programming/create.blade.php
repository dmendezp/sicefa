@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.store', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label('course', 'Curso') !!}
                <div class="input-select">
                    {!! Form::select('course_id', $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                        return $item . ' - ' . $courses->find($key)->code;
                    }), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el curso','id'=> 'course']) !!}
                </div>
                @error('course')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course').select2(); // Inicializa el campo course como select2

        // Agrega un evento de clic al botón de detalles del cultivo
        $('#course').on('click', function() {
                    var course_id = $('#course').val();
                    if (course_id) {
                        $.ajax({
                            url: '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.getcropinformation') }}',
                            method: 'GET',
                            data: {
                                id: selectedCropId
                            },
                            success: function(response) {
                                var areaSembrada = response
                                    .sown_area; // Aquí obtienes el valor del área sembrada

                                // Establece el valor en el campo oculto
                                $('#sownArea').val(areaSembrada);
                                console.log(response);
                                // Mostrar los detalles del cultivo en el modal
                                $('#cultivoInfo').html(
                                    '<p><strong>Nombre:</strong> ' + response.name + '</p>' +
                                    '<p><strong>Área sembrada:</strong> ' + response.sown_area +
                                    ' hectáreas</p>' +
                                    '<p><strong>Fecha de siembra:</strong> ' + response
                                    .seed_time + '</p>' +
                                    '<p><strong>Densidad:</strong> ' + response.density + '</p>'
                                    // Agrega más detalles si es necesario
                                );

                                // Abre el modal para mostrar la información del cultivo
                                $('#myModal').modal('show');
                            },
                            error: function() {
                                // Manejar errores si la solicitud AJAX falla
                                console.error('Error en la solicitud AJAX');
                            }
                        });
                    }
                });
    });
</script>
    
@endpush
