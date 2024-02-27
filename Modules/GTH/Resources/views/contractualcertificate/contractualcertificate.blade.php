@extends('gth::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Certificado Contactual</h1>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('cefa.contractualcertificate.search') }}">
        @csrf

        <!-- Información de la Persona -->
        <h2>Digitar Documento</h2>

        <!-- Número de Documento -->
        <div class="form-group">
            <label for="document_number">{{ trans('gth::menu.ID number:') }}</label>
            <input type="number" name="document_number" id="document_number"
                class="form-control" value="{{ old('document_number') }}"
                required>
        </div>
    </form>
    </div>
</div>

<div id="resultcontractual">

</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#document_number').change(function() {
        var document = $(this).val();

        // Realizar una solicitud AJAX para obtener los resultados de labores filtrados por cultivo
        $.ajax({
            type: 'POST',
            url: "{{ route('cefa.contractualcertificate.search') }}",
            data: {
                _token: "{{ csrf_token() }}",
                document: document
            },
            success: function(data) {
                // Actualizar el contenedor con los resultados de labores filtrados
                $('#resultcontractual').html(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>

@endsection
