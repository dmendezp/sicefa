@extends('gth::layouts.master')

@section('content')
    <form action="{{ route('cefa.contractualcertificate.view') }}" method="get">
        <label for="person_id">Número de Documento:</label>
        <input type="text" name="person_id" id="person_id" required>
        <button type="submit">Buscar</button>
    </form>

    @if(isset($contractors))
        <ul>
            @foreach($contractors as $contractor)
                <li>
                    {{ $contractor->contract_number }} -
                    <a href="{{ route('cefa.contractualcertificate.download', $contractor->id) }}">Descargar Certificado</a>
                </li>
            @endforeach
        </ul>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Captura el evento submit del formulario con AJAX
            document.getElementById('searchForm').addEventListener('submit', function (event) {
                event.preventDefault();

                // Realiza la petición AJAX
                let formData = new FormData(this);

                fetch('{{ route('cefa.contractualcertificate.search') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Muestra los resultados en el contenedor designado
                    document.getElementById('searchResults').innerHTML = data.html;
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
