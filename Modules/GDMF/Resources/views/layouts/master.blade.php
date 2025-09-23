<!DOCTYPE html>
<html lang="es">
    <head>
        @include('gdmf::layouts.partials.head')
        @stack('head')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
        <div class="wrapper">
            <!-- Navbar -->
            @include('gdmf::layouts.partials.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('gdmf::layouts.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $titleView }}</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @stack('breadcrumbs')
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        @section('content') @show
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            @include('gdmf::layouts.partials.controlSidebar')
            <!-- /.control-sidebar -->

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        @include('gdmf::layouts.partials.scripts')
        @stack('scripts')
        @section('js') @show

    </body>
</html>
