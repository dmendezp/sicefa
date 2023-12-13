@extends('senaempresa::layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ trans('senaempresa::menu.Staff') }}</h3>
                    <div class="ml-auto">
                        @if (Route::is('senaempresa.admin.*') &&
                                Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.new'))
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.new') }}"
                                class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $groupedCandidates = $staff_senaempresas->groupBy(function ($staf) {
                            // Agrupar por senaempresa_id en lugar de quarter_id
                            return $staf->senaempresa_id;
                        });
                    @endphp

                    @foreach ($groupedCandidates as $senaempresaId => $staff)
                        <div class="time-label">
                            <h1 class="title">
                                <span class="letter-wrapper"> {{ trans('senaempresa::menu.Senaempresa') }} </span>
                                <span class="letter-wrapper">{{ $senaempresaId }}</span>
                            </h1>
                        </div>
                        <div class="row">
                            @foreach ($staff as $staf)
                                <div class="col-md-4">
                                    <div class="candidate-card" style="max-width: 600px; margin: 0 10px 20px 0;">
                                        <div class="card text-center">
                                            <img src="{{ asset($staf->image) }}" alt="{{ $staf->image }}"
                                                class="card-img-top" style="max-width: 100%; border-radius: 10px;">
                                            <div class="card-body"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    @foreach ($PositionCompany as $position)
                                                        @if ($position->id == $staf->position_company_id)
                                                            <strong>{{ $position->name }}</strong>
                                                        @endif
                                                    @endforeach
                                                </h6>
                                                <h5 class="card-title text-center">
                                                    {{ $staf->Apprentice->Person->full_name }}
                                                </h5>
                                                <p class="card-subtitle text-muted"
                                                    style="margin-top: 10px; font-weight: bold;">
                                                    {{ $staf->position }}
                                                </p>
                                                @if (Route::is('senaempresa.admin.*') &&
                                                        Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.delete'))
                                                    <div class="card-buttons" style="margin-top: 10px;">
                                                        <form class="formPersonal"
                                                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.delete', $staf->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group">
                                                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.edit', ['id' => $staf->id]) }}"
                                                                    class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                                <button type="submit" class="btn btn-danger"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    @endsection


    <!--scripts utilizados para procesos-->
    @section('scripts')
        <script>
            'use strict';
            // Selecciona todos los formularios con la clase "formEliminar"
            var forms = document.querySelectorAll('.formPersonal');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Evita que el formulario se envíe de inmediato

                        Swal.fire({
                            title: "{{ trans('senaempresa::menu.Are you sure?') }}",
                            text: "{{ trans('senaempresa::menu.It is an irreversible process.') }}",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "{{ trans('senaempresa::menu.Yes, remove it') }}",
                            cancelButtonText: "{{ trans('senaempresa::menu.Cancel') }}",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Enviar el formulario usando AJAX
                                axios.post(form.action, new FormData(form))
                                    .then(function(response) {
                                        // Manejar la respuesta JSON del servidor
                                        if (response.data && response.data.mensaje) {
                                            Swal.fire({
                                                title: {{ trans('senaempresa::menu.Staff eliminated!') }},
                                                text: response.data.mensaje,
                                                icon: 'success'
                                            }).then(() => {
                                                // Recargar la página u otra acción según sea necesario
                                                location
                                                    .reload(); // Recargar la página después de eliminar
                                            });
                                        }
                                    })
                                    .catch(function(error) {
                                        // Manejar errores si es necesario
                                        console.error(error);
                                    });
                            }
                        });
                    });
                });
        </script>
    @endsection
