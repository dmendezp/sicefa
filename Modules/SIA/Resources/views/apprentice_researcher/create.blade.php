@php
    use Modules\SICA\Entities\EPS;
    use Modules\SICA\Entities\PopulationGroup;
    use Modules\SICA\Entities\PensionEntity;
    use Modules\SICA\Entities\Program;
    use Modules\SICA\Entities\Course;
    use Modules\SIA\Entities\Group;
    use Modules\SIA\Entities\Project;
@endphp

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Registrar Aprendiz Investigador</h1>

    @if (session('message'))
        <div class="alert alert-{{ session('typealert') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('sia.apprentice_researchers.store') }}" method="POST">
        @csrf

        <!-- Datos de usuario -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nickname" class="form-label">Nickname <span class="text-danger">*</span></label>
                <input type="text" name="nickname" id="nickname" class="form-control @error('nickname') is-invalid @enderror" value="{{ old('nickname') }}" required>
                @error('nickname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Datos de persona -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="document_type" class="form-label">Tipo de Documento <span class="text-danger">*</span></label>
                <select name="document_type" id="document_type" class="form-select @error('document_type') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    <option value="Cédula de ciudadanía" {{ old('document_type') == 'Cédula de ciudadanía' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                    <option value="Tarjeta de identidad" {{ old('document_type') == 'Tarjeta de identidad' ? 'selected' : '' }}>Tarjeta de identidad</option>
                    <option value="Cédula de extranjería" {{ old('document_type') == 'Cédula de extranjería' ? 'selected' : '' }}>Cédula de extranjería</option>
                    <option value="Pasaporte" {{ old('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="Documento nacional de identidad" {{ old('document_type') == 'Documento nacional de identidad' ? 'selected' : '' }}>Documento nacional de identidad</option>
                    <option value="Registro civil" {{ old('document_type') == 'Registro civil' ? 'selected' : '' }}>Registro civil</option>
                </select>
                @error('document_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="document_number" class="form-label">Número de Documento <span class="text-danger">*</span></label>
                <input type="number" name="document_number" id="document_number" class="form-control @error('document_number') is-invalid @enderror" value="{{ old('document_number') }}" required>
                @error('document_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">Nombres <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="first_last_name" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                <input type="text" name="first_last_name" id="first_last_name" class="form-control @error('first_last_name') is-invalid @enderror" value="{{ old('first_last_name') }}" required>
                @error('first_last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="second_last_name" class="form-label">Segundo Apellido</label>
                <input type="text" name="second_last_name" id="second_last_name" class="form-control @error('second_last_name') is-invalid @enderror" value="{{ old('second_last_name') }}">
                @error('second_last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="eps_id" class="form-label">EPS <span class="text-danger">*</span></label>
                <select name="eps_id" id="eps_id" class="form-select @error('eps_id') is-invalid @enderror" required>
                    <option value="">Seleccione una EPS</option>
                    @foreach (EPS::all() as $eps)
                        <option value="{{ $eps->id }}" {{ old('eps_id') == $eps->id ? 'selected' : '' }}>{{ $eps->name }}</option>
                    @endforeach
                </select>
                @error('eps_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telephone1" class="form-label">Número de Celular <span class="text-danger">*</span></label>
                <input type="number" name="telephone1" id="telephone1" class="form-control @error('telephone1') is-invalid @enderror" value="{{ old('telephone1') }}" required>
                @error('telephone1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="population_group_id" class="form-label">Población <span class="text-danger">*</span></label>
                <select name="population_group_id" id="population_group_id" class="form-select @error('population_group_id') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    @foreach (PopulationGroup::all() as $group)
                        <option value="{{ $group->id }}" {{ old('population_group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('population_group_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pension_entity_id" class="form-label">Pensión <span class="text-danger">*</span></label>
                <select name="pension_entity_id" id="pension_entity_id" class="form-select @error('pension_entity_id') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    @foreach (PensionEntity::all() as $entity)
                        <option value="{{ $entity->id }}" {{ old('pension_entity_id') == $entity->id ? 'selected' : '' }}>{{ $entity->name }}</option>
                    @endforeach
                </select>
                @error('pension_entity_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="program_id" class="form-label">Programa de Formación <span class="text-danger">*</span></label>
                <select name="program_id" id="program_id" class="form-select @error('program_id') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    @foreach (Program::all() as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                    @endforeach
                </select>
                @error('program_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="course_id" class="form-label">Ficha <span class="text-danger">*</span></label>
                <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    @foreach (Course::all() as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->code_name }}</option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="group_id" class="form-label">Grupo de Semillero <span class="text-danger">*</span></label>
                <select name="group_id" id="group_id" class="form-select @error('group_id') is-invalid @enderror" required>
                    <option value="">Seleccione...</option>
                    @foreach (Group::all() as $group)
                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="project_id" class="form-label">Proyecto</label>
                <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
                    <option value="">Seleccione...</option>
                    @foreach (Project::active()->get() as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="institution" class="form-label">Institución <span class="text-danger">*</span></label>
                <input type="text" name="institution" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution', 'SENA') }}" required>
                @error('institution')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="{{ url('/sia') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection