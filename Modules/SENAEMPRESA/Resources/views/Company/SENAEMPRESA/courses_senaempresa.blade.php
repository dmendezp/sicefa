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
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ $title }}</div>
                        <div class="card-body">
                            <form action="{{ route('cefa.curso_asociado_senaempresa') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="course_id">{{ trans('senaempresa::menu.Select a course:') }}</label>
                                    <select class="form-control" name="course_id" id="course_id">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->code }}
                                                {{ $course->program->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="senaempresa_id">{{ trans('senaempresa::menu.Select a SenaEmpresa:') }}</label>
                                    <select class="form-control" name="senaempresa_id" id="senaempresa_id">
                                        @foreach ($senaempresas as $senaempresa)
                                            <option value="{{ $senaempresa->id }}">{{ $senaempresa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ trans('senaempresa::menu.Assign Course to SenaEmpresa') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $title }}</div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('senaempresa::menu.Course ID') }}</th>
                                        <th>{{ trans('senaempresa::menu.SenaEmpresa ID') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($courses)
                                        @foreach ($courses as $course)
                                            @foreach ($course->senaempresa as $vacant)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{ $course->code }} {{ $course->program->name }}</td>
                                                    <td>{{ $senaempresa->name }}</td>
                                                    <td>
                                                        <form action="{{ route('cefa.eliminar_asociacion_empresa') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="course_id"
                                                                value="{{ $course->id }}">
                                                            <input type="hidden" name="senaempresa_id"
                                                                value="{{ $senaempresa->id }}">
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <p>{{ trans('senaempresa::menu.No associated courses were found.') }}</p>
                                    @endif


                                </tbody>
                            </table>
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
