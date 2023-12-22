<!DOCTYPE html>
<html lang="es">

<head>
    @include('hangarauto::layouts.partials.head')
    @stack('head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">


    <div class="wrapper">
        <!-- Navbar -->
        @include('hangarauto::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('hangarauto::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color:#a9c3ba;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('cefa.parking.index') }}"
                                        class="text-decoration-none">HANGARAUTO</a></li>
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
    </div>
    <!-- ./wrapper -->

    <!-- Main Footer -->
    @include('hangarauto::layouts.partials.footer')

    <!-- REQUIRED SCRIPTS -->
    @include('hangarauto::layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
