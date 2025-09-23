@extends('gdmf::layouts.master')

@section('content')
<div class="container">
    <h4 class="mb-4">Asignación de Materiales a Proyectos Formativos</h4>

    {{-- Selección de Proyecto --}}
    <div class="card mb-4">
        <div class="card-body">
            {!! Form::open(['route' => 'gdmf.academic_coordination.curriculum_planning.manage_materials.index', 'method' => 'GET']) !!}
                <div class="row align-items-end">
                    <div class="col-md-8">
                        {!! Form::label('training_project_id', 'Seleccione un Proyecto Formativo') !!}
                        {!! Form::select('training_project_id', $projects, $selectedProjectId, ['class' => 'form-control select2', 'placeholder' => 'Selecciona un proyecto', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit('Cargar Proyecto', ['class' => 'btn btn-menta']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    @if($selectedProject)
    {{-- Formulario de asignación --}}
    <div class="card mb-4">
        <div class="card-header btn-menta text-white">Asignar Material a <b>{{ $selectedProject->name }}</b></div>
        <div class="card-body">
            {!! Form::open(['route' => 'gdmf.academic_coordination.curriculum_planning.manage_materials.store', 'method' => 'POST']) !!}
                @csrf
                {!! Form::hidden('training_project_id', $selectedProject->id) !!}
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::label('element_id', 'Material') !!}
                        {!! Form::select('element_id', $elements, null, ['class' => 'form-control select2', 'required', 'placeholder' => 'Selecciona un material']) !!}
                    </div>
                    <div class="col-md-4 mt-4">
                        {!! Form::submit('Asignar Material', ['class' => 'btn btn-success w-100']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    {{-- Materiales asignados --}}
    <div class="card">
        <div class="card-header bg-dark text-white">Materiales Asignados</div>
        <div class="card-body table-responsive">
            @if(count($assignedMaterials))
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Categoría</th>
                        <th>Tipo Compra</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignedMaterials as $material)
                    <tr>
                        <td>{{ $material->element->name }}</td>
                        <td>{{ $material->element->measurement_unit->name ?? '-' }}</td>
                        <td>{{ $material->element->category->name ?? '-' }}</td>
                        <td>{{ $material->element->kind_of_purchase->name ?? '-' }}</td>
                        <td>${{ number_format($material->element->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('gdmf.academic_coordination.curriculum_planning.manage_materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este material?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Quitar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-center">Este proyecto aún no tiene materiales asignados.</p>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endpush
