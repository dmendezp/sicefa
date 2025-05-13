@extends('pserenacefa::layouts.master')

@section('content')

<div class="container">
    <h2>Crear Horario</h2>
    <form action="{{ route('pserenacefa.admin.admin.storehorarios') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="environment1_id">Ambiente</label>
            <select name="environment1_id" class="form-control" required>
                <option value="">Seleccione un ambiente</option>
                @foreach($environments as $env)
                    <option value="{{ $env->id }}">{{ $env->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="courses_id">Curso</label>
            <select name="courses_id" class="form-control" required>
                <option value="">Seleccione un curso</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->code }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="day_of_week">Día de la semana</label>
            <select name="day_of_week" class="form-control" required>
                <option value="">Seleccione un día</option>
                @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'] as $dia)
                    <option value="{{ $dia }}">{{ ucfirst($dia) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_time">Hora de inicio</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_time">Hora de fin</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar horario</button>
    </form>
</div>

@endsection    