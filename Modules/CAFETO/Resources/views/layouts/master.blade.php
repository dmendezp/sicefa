<!DOCTYPE html>
<html lang="es">
    <head>
        @include('cafeto::layouts.partials.head')
        @stack('head')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('cafeto::layouts.partials.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('cafeto::layouts.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $view_title }}</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('cefa.cafeto.index') }}" class="text-decoration-none text-secondary fw-bold">
                                            CAFETO
                                        </a>
                                    </li>
                                    @stack('breadcrumbs')
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <!-- Container-fluid -->
                    <div class="container-fluid">
                        @section('content') @show
                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            @include('cafeto::layouts.partials.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        @include('cafeto::layouts.partials.scripts')
        @stack('scripts')
    </body>
</html>
