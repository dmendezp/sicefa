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
                            <th style="width: 200px;">
                                <a href="{{ route('registro') }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-plus"></i> Agregar
                                </a>
                            </th>

                        </tr>
                    </thead>
                         <tbody>
                        @foreach ($staff_senaempresas as $StaffSenaempresa)
                            <tr>
                                <td>{{ $StaffSenaempresa->id }}</td>
                                <td>@foreach ($PositionCompany as $position)
                                    @if ($position->id == $StaffSenaempresa->position_company_id)
                                    {{ $StaffSenaempresa->position_company_id }} {{ $position->description }}
                                    @endif
                                    @endforeach</td>
                                    <td>{{ $StaffSenaempresa->Apprentice->Person->first_name }} {{ $StaffSenaempresa->Apprentice->Person->first_last_name }}</td>                                <form action="{{ route('eliminar_personal', $StaffSenaempresa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <a href="{{ route('editar_personal', ['id' => $StaffSenaempresa->id]) }}"
                                            class="btn btn-info btn-sm">Editar</a>

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este ?')">Eliminar</button>
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
