@extends('sigac::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Programar Actividad para el Ambiente: {{ $environment->name }}</h3>

                <form action="{{ route('sigac.academic_coordination.environmentcontrol.activity.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="environment_id" value="{{ $environment->id }}">

                    <div class="form-group">
                        <label>Nombre de la Actividad:</label>
                        <input type="text" name="activity_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción:</label>
                        <textarea name="activity_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Fecha:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Hora de Inicio:</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Hora de Fin:</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        {!! Form::label('person_id', trans('Persona Responsable')) !!}
                        {!! Form::select('person_id', [], null, ['class' => 'form-control person_id']) !!}
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
<script>
   $(document).ready(function () {
        // Inicializar Select2 en campos de selección de personas
        $('select[name="person_id"]:last').select2({
            placeholder: 'Seleccione una persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.academic_coordination.environmentcontrol.environment.activity.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
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

        // ==== SweetAlert2 para errores de validación ====
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Errores en el formulario',
                html: `
                    <ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `
            });
        @endif

        // ==== SweetAlert2 para éxito ====
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // ==== SweetAlert2 para errores personalizados ====
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: '{{ session('error') }}'
            });
        @endif
    });
</script>
@endpush