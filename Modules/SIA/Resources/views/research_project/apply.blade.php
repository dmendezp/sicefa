@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>Postularse a un Proyecto de Investigación</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('sia.apprentice.research_project.apply.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Proyecto de Investigación</label>
            <select name="research_project_id" id="projectSelect" class="form-control" required>
                <option value="">Seleccione un proyecto</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Aquí se cargará la información del proyecto -->
        <div id="projectInfo" style="display: none;">
            <h5>Información del Proyecto</h5>
            <p><strong>Descripción:</strong> <span id="infoDescription"></span></p>
            <p><strong>Fechas:</strong> <span id="infoDates"></span></p>
            <p><strong>Estado:</strong> <span id="infoState"></span></p>
            <p><strong>Responsable:</strong> <span id="infoResponsible"></span></p>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Postularme</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#projectSelect').change(function() {
        const projectId = $(this).val();

        if (projectId) {
            $.ajax({
                url: '{{ route('sia.apprentice.research_project.showinfo') }}',
                method: 'GET',
                data: { id: projectId },
                success: function(data) {
                    $('#projectInfo').show();
                    $('#infoDescription').text(data.description);
                    $('#infoDates').text(data.start_date + ' - ' + data.end_date);
                    $('#infoState').text(data.state);
                    $('#infoResponsible').text(data.responsible);
                },
                error: function() {
                    alert('No se pudo cargar la información.');
                }
            });
        } else {
            $('#projectInfo').hide();
        }
    });
});
</script>
@endpush
