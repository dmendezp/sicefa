<!DOCTYPE html>
<html lang="es">

<head>
    @include('sia::layouts.partials.head')
    @stack('head')
    <style>
        .button-register-sale {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 50px;
            right: 20px;
            color: #FFF;
            border-radius: 60px;
            text-align: center;
            font-size: 30px;
            z-index: 100;
            background-color: #bc6c25;
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        @include('sia::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('sia::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $view['titleView'] }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cefa.sia.index') }}" class="text-decoration-none text-secondary fw-bold">
                                        SIA
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

        <!-- Control Sidebar -->
        @include('sia::layouts.partials.controlSidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('sia::layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('sia::layouts.partials.scripts')
    @stack('scripts')

    <!-- SweetAlert2 Plugin -->
    @include('sia::layouts.partials.plugins.sweetalert2')
    <!-- DataTables Plugin -->
    @include('sia::layouts.partials.plugins.datatables')
    <!-- Toastr Plugin -->
    @include('sia::layouts.partials.plugins.toastr')
</body>

</html>