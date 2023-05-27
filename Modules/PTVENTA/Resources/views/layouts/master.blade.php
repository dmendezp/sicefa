<!DOCTYPE html>
<html lang="es">
    <head>
        @include('ptventa::layouts.partials.head')
        @stack('head')
    </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">

    <div class="wrapper">
        <!-- Navbar -->
        @include('ptventa::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('ptventa::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @stack('breadcrumbs')
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
        @include('ptventa::layouts.partials.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('ptventa::layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
