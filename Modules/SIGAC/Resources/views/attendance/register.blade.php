@extends('sigac::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('sigac::attendance.Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::attendance.Register') }}</li>
@endpush

@section('content')

    {{-- Se incluye el componente de la vista principal de registro de asistencia por aprendices --}}
    @livewire('sigac::attendance.consult-apprentices', ['environments'=>$environments, 'programs'=>$programs])

@endsection

@push('scripts')
    @livewireScripts()
    <script>
        function actualizarHora() {
            var fecha_actual = new Date();
            var dia = fecha_actual.getDate();
            var mes = fecha_actual.getMonth() + 1; // Los meses en JavaScript son indexados desde 0
            var año = fecha_actual.getFullYear();
            var hora = fecha_actual.getHours();
            var minutos = fecha_actual.getMinutes();
            var segundos = fecha_actual.getSeconds();

            var fecha_formateada = dia + "/" + mes + "/" + año + " " + hora + ":" + minutos + ":" + segundos;
            document.getElementById("fecha-hora").innerHTML = fecha_formateada;
        }

        // Actualizar la hora cada segundo (1000 milisegundos)
        setInterval(actualizarHora, 1000);

        // Ejecutar la función por primera vez para mostrar la hora actual inmediatamente
        actualizarHora();
    </script>

@endpush
