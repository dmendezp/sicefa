@extends('sigac::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.instructor.programming.program_request.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('instructor', 'Instructor') !!}
                    <div class="input-select">
                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control instructor', 'required']) !!}
                    </div>
                </div>
                <b id="titulo"></b>
                <div id="profession"></div>
                <br>
                <div class="form-group">
                    {!! Form::label('Programa', 'Programa') !!}
                    {!! Form::select('program_id', $program, null, [
                        'class' => 'form-control',
                        'placeholder' => '-- Seleccione --',
                        'id' => 'program',
                        'height' => '50px',
                    ]) !!}
                </div>
                <br>
                <div class="form-group">
                    {!! Form::label('program_especial', 'Programa Especial') !!}
                    {!! Form::select('program_especial_id', $program_especial, null, [
                        'class' => 'form-control',
                        'placeholder' => '-- Seleccione --',
                        'id' => 'program_especial',
                        'height' => '50px',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('quota', 'Cupo') !!}
                    {!! Form::number('quota',  null, ['class' => 'form-control','placeholder' => 'Cupos','id' => 'quota','required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('start_date', 'Fecha de Inicio') !!}
                    {!! Form::date('start_date',  null, ['class' => 'form-control','placeholder' => 'Fecha de inicio','id' => 'star_date','required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end_date', 'Fecha Final') !!}
                    {!! Form::date('end_date',  null, ['class' => 'form-control','placeholder' => 'Fecha final','id' => 'end_date']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('municipality_id', 'Municipio') !!}
                    {!! Form::select('municipality_id', $municipalities, null, [
                        'class' => 'form-control',
                        'placeholder' => '-- Seleccione --',
                        'id' => 'munipality',
                        'height' => '50px',
                        'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('observation', trans('agrocefa::labor.Observation')) !!}
                    {!! Form::textarea('observation', old('observation'), [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese una observación',
                        'style' => 'max-height: 100px;',
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <label for="horario">{{ trans('Horario') }}</label>
                <p>Ingrese las fechas de las formaciones</p>
                <!-- Resultado de Aprendizaje -->
                <div class="card">
                    <div class="card-body">
                        <div id="dates_container">
                            <!-- Campo de selección de resultado de aprendizaje -->
                            <div class="row align-items-center datesrow">
                                <div class="col-8">
                                    <div class="form-group">
                                        {!! Form::label('dates', 'Fecha') !!}
                                        {!! Form::date('dates[]', null, ['class' => 'form-control dates', 'required']) !!}
                                        {!! Form::label('start_time', 'Hora de inicio') !!}
                                        {!! Form::time('start_time[]', null, ['class' => 'form-control start_time', 'required']) !!}
                                        {!! Form::label('end_time', 'Hora fin') !!}
                                        {!! Form::time('end_time[]', null, ['class' => 'form-control end_time', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary add_dates"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('empresa', trans('Nombre Empresa')) !!}
                    {!! Form::text('empresa', old('empresa'), [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el nombre de la empresa',
                        'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', trans('Dirección')) !!}
                    {!! Form::text('address', old('address'), [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese la dirección',
                        'required'
                    ]) !!}
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5><b>Datos del Solicitante</b></h5>
                        <div class="form-group">
                            {!! Form::label('applicant', trans('Nombre Completo')) !!}
                            {!! Form::text('applicant', old('applicant'), [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese el nombre completo',
                                'required'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', trans('Correo')) !!}
                            {!! Form::email('email', old('email'), [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese el correo',
                                'required'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('telephone', trans('Telefono')) !!}
                            {!! Form::number('telephone', old('telephone'), [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese el numero de telefono',
                                'required'
                            ]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@if(session('success'))
    <script>
        var successMessage = {!! json_encode(session('success')) !!};
        Swal.fire({
            icon: 'success',
            title: successMessage,
            showConfirmButton: true,
            timer: false,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif
@endsection
@push('scripts')
<script>
    $(function() {
        $('#program').select2();
        $('#munipality').select2();
    })
   
    $(document).ready(function() {
        // Inicializar Select2 en campos de selección de instructor
        $('.instructor').select2({
            placeholder: 'Seleccione una persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.programming.program_request.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });

        // Manejador de eventos para el cambio en el campo "Unidad Productiva"
        $('.instructor').on('change', function() {
            var person_id = $(this).val(); // Obtener el ID de la unidad productiva seleccionada

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('sigac.programming.program_request.searchprofession') }}',
                method: 'GET',
                data: {
                    person_id: person_id
                },
                success: function(response) {
                    // Verificar si hay un responsable en la respuesta
                    if (response.professions) {
                        $('#titulo').text("Profesion");
                        $('#profession').text(response.professions.name);
                    } else {
                        // Mostrar un campo de selección vacío y limpiar el campo "Profesion"
                        $('#profession').text('');
                    }
                },
                error: function() {
                    // Manejar errores si la solicitud AJAX falla
                    console.error('Error en la solicitud AJAX');
                }
            });
        });

        // Función para agregar fila de resultado de aprendizaje
        $(document).on('click', '.add_dates', function() {
            var newRowHtml = `
                <hr id="hr">
                <div class="row align-items-center datesrow">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::label('dates', 'Fecha') !!}
                            {!! Form::date('dates[]', null, ['class' => 'form-control dates', 'required']) !!}
                            {!! Form::label('start_time', 'Hora de inicio') !!}
                            {!! Form::time('start_time[]', null, ['class' => 'form-control start_time', 'required']) !!}
                            {!! Form::label('end_time', 'Hora fin') !!}
                            {!! Form::time('end_time[]', null, ['class' => 'form-control end_time', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary add_dates"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
            $('#dates_container').append(newRowHtml); // Agregar nueva fila al contenedor
            
        });

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.datesrow').remove();
            $('#hr').remove();
        });
    });
</script>
@endpush