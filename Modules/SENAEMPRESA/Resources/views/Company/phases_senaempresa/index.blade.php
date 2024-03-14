@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <br>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>{{ trans('senaempresa::menu.Name') }}</th>
                                <th>{{ trans('senaempresa::menu.Description') }}</th>
                                <th>{{ trans('senaempresa::menu.Quarter') }}</th>
                                @if (Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.new'))
                                    <th>
                                        <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.new') }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($senaempresas as $senaempresa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $senaempresa->name }}</td>
                                    <td>{{ $senaempresa->description }}</td>
                                    <td>{{ $senaempresa->quarter->name }}</td>
                                    @if (Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.edit'))
                                        <form
                                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.delete', $senaempresa->id) }}"
                                            method="POST" class="formsena">
                                            @csrf
                                            @method('DELETE')

                                            <td>
                                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.edit', ['id' => $senaempresa->id]) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash-alt"></i></button>
                                        </form>
                                        </td>
                                    @endif
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
        var forms = document.querySelectorAll('.formsena');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: '{{ trans('senaempresa::menu.Are you sure?') }}',
                        text: '{{ trans('senaempresa::menu.It is an irreversible process.') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{ trans('senaempresa::menu.Yes, delete it') }}',
                        cancelButtonText: '{{ trans('senaempresa::menu.Cancel') }}' // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar el formulario usando AJAX
                            axios.post(form.action, new FormData(form))
                                .then(function(response) {
                                    // Manejar la respuesta JSON del servidor
                                    if (response.data && response.data.mensaje) {
                                        Swal.fire({
                                            title: '{{ trans('senaempresa::menu.SenaEmpresa deleted!') }}',
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
