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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cargo</th>
                                    <th>Aprendiz</th>
                                    <th>Imagen Personal</th>
                                    <th>
                                        <a href="{{ route('registro') }}" class="btn btn-success btn-sm"><i
                                                class="fas fa-user-plus"></i></a>
                                        </a>
                                    </th>

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
                                                    {{ $position->description }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $StaffSenaempresa->Apprentice->Person->first_name }}
                                            {{ $StaffSenaempresa->Apprentice->Person->first_last_name }}</td>
                                        <td><img src="{{ asset($StaffSenaempresa->image) }}"
                                                alt="{{ $StaffSenaempresa->image }}"></td>
                                        <form action="{{ route('eliminar_personal', $StaffSenaempresa->id) }}"
                                            method="POST" class="formPersonal">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="{{ route('editar_personal', ['id' => $StaffSenaempresa->id]) }}"
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
            var forms = document.querySelectorAll('.formPersonal');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Evita que el formulario se envíe de inmediato

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: 'Es un proceso irreversible.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarlo',
                            cancelButtonText: 'Cancelar' // Cambiar el texto del botón "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Enviar el formulario usando AJAX
                                axios.post(form.action, new FormData(form))
                                    .then(function(response) {
                                        // Manejar la respuesta JSON del servidor
                                        if (response.data && response.data.mensaje) {
                                            Swal.fire({
                                                title: 'Personal eliminado!',
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
