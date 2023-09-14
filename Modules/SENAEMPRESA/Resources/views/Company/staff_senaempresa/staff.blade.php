@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">

        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <br>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Id') }}</th>
                                <th>{{ trans('senaempresa::menu.Position') }}</th>
                                <th>{{ trans('senaempresa::menu.Apprentice') }}</th>
                                <th>{{ trans('senaempresa::menu.self-image') }}</th>
                                @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                                    <th>
                                        <a href="{{ route('company.senaempresa.nuevo_personal') }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                        </a>
                                    </th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff_senaempresas as $StaffSenaempresa)
                                <tr>
                                    <td>{{ $StaffSenaempresa->id }}</td>
                                    <td>
                                        @foreach ($PositionCompany as $position)
                                            @if ($position->id == $StaffSenaempresa->position_company_id)
                                                {{ $StaffSenaempresa->position_company_id }}
                                                {{ $position->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $StaffSenaempresa->Apprentice->Person->first_name }}
                                        {{ $StaffSenaempresa->Apprentice->Person->first_last_name }}</td>
                                        <td>
                                            <img src="{{ asset($StaffSenaempresa->image) }}" alt="{{ $StaffSenaempresa->image }}">
                                        </td>
                                    @if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa')
                                        <form
                                            action="{{ route('company.senaempresa.eliminar_personal', $StaffSenaempresa->id) }}"
                                            method="POST" class="formPersonal">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="{{ route('company.senaempresa.editar_personal', ['id' => $StaffSenaempresa->id]) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
