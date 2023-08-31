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
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-center"><strong><em><span>Cargos</span></em></strong></h1>
            <div class="col-md-3">


            </div>
            <div class="card-body">
                <table id="datatable" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Requerimientos</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th style="width: 200px;">
                                <a href="{{ route('Nueva') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Agregar
                                </a>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($position_companies as $PositionCompany)
                            <tr>
                                <td>{{ $PositionCompany->id }}</td>
                                <td>{{ $PositionCompany->requirement }}</td>
                                <td>{{ $PositionCompany->description }}</td>
                                <td>{{ $PositionCompany->state }}</td>
                                <form action="{{ route('eliminar_cargo', $PositionCompany->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <a href="{{ route('editar_cargo', ['id' => $PositionCompany->id]) }}"
                                            class="btn btn-info btn-sm">Editar</a>

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este cargo?')">Eliminar</button>
                                </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        < @section('content') @show <!-- Control Sidebar -->

            <!-- /.control-sidebar -->


    </div>

    <!-- Main Footer -->
    @include('senaempresa::layouts.structure.footer')

    @include('senaempresa::layouts.structure.scripts')

    <!--scripts utilizados para procesos-->
    @section('scripts')
    @show

    @section('dataTables')
    @show
</body>

</html>
