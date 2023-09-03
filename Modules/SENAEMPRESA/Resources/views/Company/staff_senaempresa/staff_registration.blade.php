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
                            <form action="{{ route('Nuevas') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="position_company_id" class="form-label">Id Cargo</label>
                                    <select class="form-control" name="position_company_id"
                                        aria-label="Selecciona un Cargo">
                                        <option value="" selected>Selecciona un Cargo</option>
                                        @foreach ($PositionCompany as $positionCompany)
                                            <option value="{{ $positionCompany->id }}">
                                                {{ $positionCompany->id }}
                                                {{ $positionCompany->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="apprentice_id" class="form-label">Id Aprendiz</label>
                                    <select class="form-control" name="apprentice_id"
                                        aria-label="Selecciona un Aprendiz">
                                        <option value="" selected>Selecciona un Aprendiz</option>
                                        @foreach ($Apprentices as $Apprentice)
                                            <option value="{{ $Apprentice->id }}">
                                                {{ $Apprentice->Person->document_number }}
                                                {{ $Apprentice->Person->first_name }}
                                                {{ $Apprentice->Person->first_last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Imgen Personal</label><br>
                                    <input type="file" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <a href="{{ route('personal') }}" class="btn btn-danger btn-xl">Cancelar</a>
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
