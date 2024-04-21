@extends('sigac::layouts.master')

@push('head')

@end

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::attendance.Breadcrumb_Active_Attendance') }}</a>
    </li>
    <li
    </
class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::pointsApprentice') }}</li>
@endpush

@section('content')
<div class="container">
    <form method="POST" action="{{ route('sigac.instructor.points.points.index') }}">
        @csrf

        <div class="form-group">
            <label for="apprentice">Seleccionar Aprendiz</label>
            <select id="apprentice" name="apprentice" class="form-control">
                <option value="">Seleccionar Aprendiz</option>
                @foreach($apprentices as $apprentice)
                    <option value="{{ $apprentice->id }}">{{ $apprentice->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="update">Fecha de Actualización</label>
            <input type="datetime-local" id="update" name="update" class="form-control">
        </div>

        <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" id="quantity" name="quantity" class="form-control">
        </div>

        <div class="form-group">
            <label for="theme">Tema</label>
            <input type="text" id="theme" name="theme" class="form-control">
        </div>

        <div class="form-group">
            <label for="state">Estado</label>
            <select id="state" name="state" class="form-control">
                <option value="Positivo">Positivo</option>
                <option value="Negativo">Negativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    @if(isset($point))
    <form method="POST" action="{{ route('points.destroy', $point->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
    @endif
</div>
@endsection

@push('scripts')
    <script src='{{ asset('libs/fullcalendar-6.1.8/dist/index.global.min.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endpush
