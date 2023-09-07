<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')

<body>
    @csrf
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        @include('senaempresa::layouts.structure.breadcrumb')

        <div class="container">
            <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ trans('senaempresa::menu.Name') }}</th>
                                    <th>{{ trans('senaempresa::menu.Description') }}</th>
                                    <th style="width: 200px;">
                                        <a href="{{ route('cefa.agrega') }}" class="btn btn-success btn-sm"><i
                                                class="fas fa-user-plus"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($senaempresas as $senaempresa)
                                    <tr>
                                    <td>{{ $senaempresa->id }}</td>
                                        <td>{{ $senaempresa->name }}</td>
                                        <td>{{ $senaempresa->description }}</td>
                                        <form action="{{ route('cefa.eliminar_senaempresa', $senaempresa->id) }}"
                                            method="POST" class="formsena">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="{{ route('cefa.editarlo', ['id' => $senaempresa->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        @section('content')
        @show

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->


    </div>

    <!-- Main Footer -->
    @include('senaempresa::layouts.structure.footer')

    @include('senaempresa::layouts.structure.scripts')

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
    @show

    @section('dataTables')
    @show


</body>

</html>
