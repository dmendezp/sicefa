@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>Postulaciones para: {{ $project->title }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulario Nueva Postulación -->
    <form action="{{ route('sia.admin.research_project.applications.store', $project) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Aprendiz</label>
            <select name="apprentice_id" class="form-control apprentice_id"></select>
        </div>
        <button class="btn btn-primary">Agregar Postulación</button>
    </form>

    <!-- Lista de Postulaciones -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Aprendiz</th>
                <th>Estado</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $app)
                <tr>
                    <td>{{ $app->apprentice->full_name }}</td>
                    <td>{{ $app->status }}</td>
                    <td>{{ $app->observations }}</td>
                    <td>
                        <!-- Form actualizar estado -->
                        <form action="{{ route('sia.admin.research_project.applications.update', $app) }}" method="POST" style="display:inline-block;">
                            @csrf @method('PATCH')
                            <select name="status">
                                <option {{ $app->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option {{ $app->status == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option {{ $app->status == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                            <input type="text" name="observations" value="{{ $app->observations }}" placeholder="Observaciones">
                            <button class="btn btn-sm btn-success">Guardar</button>
                        </form>

                        <!-- Form eliminar -->
                        <form action="{{ route('sia.admin.research_project.applications.destroy', $app) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script Select2 -->
<script>
    $(document).ready(function() {
        $('select.apprentice_id').select2({
            placeholder: 'Buscar aprendiz...',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sia.admin.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return { id: item.id, text: item.text };
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection
