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

            <h1 class="text-center"><strong><em><span>Personal</span></em></strong></h1>
            <div class="col-md-3">


            </div>
            <div class="card-body">
                <table id="datatable" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cargo</th>
                            <th>Aprendiz</th>
                            <th>Imagen</th>
                            <th style="width: 200px;">
                                <a href="{{ route('Nuevo') }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-plus"></i> Agregar
                                </a>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Cargo 1</td>
                        <td>Aprendiz 2</td>
                        <td>Imgen Personal</td>
                        <td>Editar|Eliminar</td>
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
