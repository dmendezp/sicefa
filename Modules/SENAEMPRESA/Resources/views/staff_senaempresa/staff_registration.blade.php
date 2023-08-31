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
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="formulario">
                        <div class="card-header">{{ $title }}</div>

                        <div class="card-body">
                            <form action="{{ route('Nueva') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="position_company_id" class="form-label">Id Cargo</label>
                                    <select class="form-control" name="position_company_id"
                                        aria-label="Selecciona un Cargo">
                                        <option value="" selected>Selecciona un Cargo</option>
                                        @foreach ($PositionCompany as $positionCompany)
                                            <option value="{{ $positionCompany->id }}">
                                                {{ $positionCompany->description }} (ID: {{ $positionCompany->id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                </div>


aprendiz

                          
                               

                                <button type="submit" class="btn btn-success">Agregar</button>
                                <a href="{{ route('carga') }}" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div><br>
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