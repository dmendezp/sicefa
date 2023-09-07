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
                            <form action="{{ route('company.senaempresa.guardado') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name"
                                        class="form-label">{{ trans('senaempresa::menu.Name') }}</label>
                                    <textarea class="form-control" id="name" name="name" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="description"
                                        class="form-label">{{ trans('senaempresa::menu.Description') }}</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>


                                <button type="submit"
                                    class="btn btn-success">{{ trans('senaempresa::menu.Add') }}</button>
                                <a href="{{ route('company.senaempresa') }}"
                                    class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
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
