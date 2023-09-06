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
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($senaempresas as $senaempresa)
                                    <tr>
                                        <td>{{ $senaempresa->id }}</td>
                                        <td>{{ $senaempresa->name }}</td>
                                        <td>{{ $senaempresa->description }}</td>
                                        <td>

                                            <a href="" class="btn btn-success">Editar</a>
                                            <a href="" class="btn btn-success">Eliminar</a>
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
    @show

    @section('dataTables')
    @show


</body>

</html>
