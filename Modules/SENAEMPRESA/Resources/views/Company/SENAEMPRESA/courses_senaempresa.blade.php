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

        <div class="container mt-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="vacantes">
                        <div class="card-header">{{ $title }}</div>
                        <div class="card-body">
                            <form action="{{ route('curso_asociado_senaempresa') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="course_id">Seleccione un curso:</label>
                                    <select class="form-control" name="course_id" id="course_id">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->code }}
                                                {{ $course->program->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="senaempresa_id">Seleccione SenaEmpresa:</label>
                                    <select class="form-control" name="senaempresa_id" id="senaempresa_id">
                                        @foreach ($senaempresas as $senaempresa)
                                            <option value="{{ $senaempresa->id }}">{{ $senaempresa->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Asignar Curso a SenaEmpresa</button>
                            </form>
                        </div>
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
