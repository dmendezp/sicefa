@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Aprendiz Investigador</h1>

    @if (session('message'))
        <div class="alert alert-{{ session('typealert') }}">{{ session('message') }}</div>
    @endif

    <form action="{{ route('sia.apprentice_researchers.store') }}" method="POST">
        @csrf

        <!-- Datos de usuario -->
        <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" value="{{ old('nickname') }}" required>
            @error('nickname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo Institucional</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Datos de persona -->
        <div class="form-group">
            <label for="document_type">Tipo de Documento</label>
            <select name="document_type" class="form-control @error('document_type') is-invalid @enderror" required>
                <option value="CC" {{ old('document_type') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                <option value="TI" {{ old('document_type') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="CE" {{ old('document_type') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
            </select>
            @error('document_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="document_number">Número de Documento</label>
            <input type="text" name="document_number" class="form-control @error('document_number') is-invalid @enderror" value="{{ old('document_number') }}" required>
            @error('document_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="first_name">Primer Nombre</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="first_last_name">Primer Apellido</label>
            <input type="text" name="first_last_name" class="form-control @error('first_last_name') is-invalid @enderror" value="{{ old('first_last_name') }}" required>
            @error('first_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="second_last_name">Segundo Apellido</label>
            <input type="text" name="second_last_name" class="form-control @error('second_last_name') is-invalid @enderror" value="{{ old('second_last_name') }}">
            @error('second_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Género</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenino</option>
                <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone1">Teléfono</label>
            <input type="text" name="telephone1" class="form-control @error('telephone1') is-invalid @enderror" value="{{ old('telephone1') }}" required>
            @error('telephone1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="personal_email">Correo Personal</label>
            <input type="email" name="personal_email" class="form-control @error('personal_email') is-invalid @enderror" value="{{ old('personal_email') }}" required>
            @error('personal_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="blood_type">Tipo de Sangre</label>
            <select name="blood_type" class="form-control @error('blood_type') is-invalid @enderror" required>
                <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
            </select>
            @error('blood_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Datos de aprendiz -->
        <div class="form-group">
            <label for="eps_id">EPS</label>
            <select name="eps_id" class="form-control @error('eps_id') is-invalid @enderror" required>
                <option value="">Seleccione una EPS</option>
                @foreach (\Modules\SICA\Entities\EPS::all() as $eps)
                    <option value="{{ $eps->id }}" {{ old('eps_id') == $eps->id ? 'selected' : '' }}>{{ $eps->name }}</option>
                @endforeach
            </select>
            @error('eps_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="program_id">Programa</label>
            <select name="program_id" class="form-control @error('program_id') is-invalid @enderror" required>
                <option value="">Seleccione un programa</option>
                @foreach (\Modules\SICA\Entities\Program::all() as $program)
                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                @endforeach
            </select>
            @error('program_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="course_id">Curso</label>
            <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                <option value="">Seleccione un curso</option>
                @foreach (\Modules\SICA\Entities\Course::all() as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="group_id">Grupo</label>
            <select name="group_id" class="form-control @error('group_id') is-invalid @enderror" required>
                <option value="">Seleccione un grupo</option>
                @foreach (\Modules\SIA\Entities\Group::all() as $group)
                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
            @error('group_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="project_id">Proyecto</label>
            <select name="project_id" class="form-control @error('project_id') is-invalid @enderror">
                <option value="">Seleccione un proyecto</option>
                @foreach (\Modules\SIA\Entities\Project::all() as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                @endforeach
            </select>
            @error('project_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="institution">Institución</label>
            <input type="text" name="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution') }}">
            @error('institution')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_date">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection