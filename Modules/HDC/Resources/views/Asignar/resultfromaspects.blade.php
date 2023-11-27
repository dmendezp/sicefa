@extends('hdc::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid mt">
        <div class="row justify-content-center">
            <div class="card card-success card-outline shadow col-md-5 mt-3">
                <div class="card-header">
                    <a href="{{ route('cefa.hdc.assign_environmental_aspects') }}"><button type="submit" class="btn btn-success"><i class="fas fa-add"></i></button></a>
                </div>
                <div class="card-body">
                    <form id="unidadForm">
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('hdc::assign_environmental_aspects.label1') }}</label>
                            <select name="productive_unit_id" class="form-control" required>
                                <option value="">{{ trans('hdc::assign_environmental_aspects.select1') }}</option>
                                @foreach ($productive_unit as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <center><button type="submit" class="btn btn-success">{{ trans('hdc::assign_environmental_aspects.btn2') }}</button></center>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contenedor para mostrar la tabla de resultados -->
        <div id="resultadosContainer"></div>
    </div>
</div>

@push('scripts')
<script>
    // Escucha el envío del formulario y realiza la solicitud AJAX
    $('#unidadForm').on('submit', function(e) {
        e.preventDefault(); // Evita el envío del formulario por defecto

        // Realiza una solicitud AJAX para obtener los resultados
        $.ajax({
            url: "{{ route('cefa.hdc.mostrarResultados') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                // Actualiza el contenido del contenedor con la tabla de resultados
                $('#resultadosContainer').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>

@endpush
@endsection
