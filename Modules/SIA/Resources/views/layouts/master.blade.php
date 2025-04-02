<!DOCTYPE html>
<html lang="es">
    <head>
        @include('sia::layouts.partials.head')
        @stack('head')
        <style>
            .button-register-action {
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
            }
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
                            <h1 class="m-0">{{ $view['titleView'] ?? 'Título de la Vista' }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('cefa.sia.index') }}" class="text-decoration-none">SIA</a></li>
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
                    @if(!Route::is('cefa.sia.*') && Auth::user()->havePermission('sia.'.getRoleRouteName(Route::currentRouteName()).'.action.register'))
                        <a href="{{ Route('sia.'.getRoleRouteName(Route::currentRouteName()).'.action.register') }}" class="button-register-action bg-primary pt-2 pe-1">
                            <i class="fa-solid fa-plus fa-bounce"></i>
                        </a>
                    @endif
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
</body>

</html>
