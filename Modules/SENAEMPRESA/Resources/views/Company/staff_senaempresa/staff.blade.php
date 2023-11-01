@extends('senaempresa::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-purple card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('senaempresa::menu.Quarter') }}</h3>
                    @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                        <th>
                            <a href="{{ route('company.senaempresa.nuevo_personal') }}" class="btn btn-success btn-sm"><i
                                    class="fas fa-user-plus"></i></a>
                            </a>
                        </th>
                    @endif
                </div>

                <div class="card-body">
                    @php
                        $groupedCandidates = $staff_senaempresas->groupBy(function ($candidate) {
                            // Obtener el trimestre a partir de quarter_id
                            return $candidate->quarter_id;
                        });
                    @endphp

                    @foreach ($groupedCandidates as $quarter => $candidates)
                        <div class="time-label">
                            <span class="bg-blue">
                                {{ trans('senaempresa::menu.Quarter') }} {{ $quarter }}
                            </span>
                        </div>
                        <div class="row">
                            @foreach ($candidates as $candidate)
                                <div class="col-md-4">
                                    <div class="candidate-card" style="max-width: 600px; margin: 0 10px 20px 0;">
                                        <div class="card text-center">
                                            <img src="{{ asset($candidate->image) }}" alt="{{ $candidate->image }}"
                                                class="card-img-top" style="max-width: 100%; margin: 0 10px;">
                                            <div class="card-body"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    @foreach ($PositionCompany as $position)
                                                        @if ($position->id == $candidate->position_company_id)
                                                            <strong>{{ $position->name }}</strong>
                                                        @endif
                                                    @endforeach
                                                </h6>
                                                <h5 class="card-title text-center">
                                                    {{ $candidate->Apprentice->Person->first_name }}
                                                    {{ $candidate->Apprentice->Person->first_last_name }}
                                                </h5>
                                                <p class="card-subtitle text-muted"
                                                    style="margin-top: 10px; font-weight: bold;">
                                                    {{ $candidate->position }}
                                                </p>
                                                <div class="card-buttons" style="margin-top: 10px;">
                                                    @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                                                        <form
                                                            action="{{ route('company.senaempresa.eliminar_personal', $candidate->id) }}"
                                                            method="POST" class="formPersonal">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group">
                                                                <a href="{{ route('company.senaempresa.editar_personal', ['id' => $candidate->id]) }}"
                                                                    class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                                <button type="submit" class="btn btn-danger"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
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
    </section>
@stop






















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
                        title: {{ trans('senaempresa::menu.Are you sure?') }},
                        text: {{ trans('senaempresa::menu.It is an irreversible process.') }},
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: {{ trans('senaempresa::menu.Yes, remove it') }},
                        cancelButtonText: {{ trans('senaempresa::menu.Cancel') }} // Cambiar el texto del botón "Cancelar"
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
