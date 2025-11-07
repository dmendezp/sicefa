<!DOCTYPE html>
<html lang="es">

<head>
    @include('cafeto::layouts.partials.head')
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
        }

        .button-register-sale:hover {
            color: #FFF;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
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
                            <h1 class="m-0">{{ $view['titleView'] }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cefa.cafeto.index') }}"
                                        class="text-decoration-none text-secondary fw-bold">
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
                    @if(!Route::is('cefa.cafeto.*') && Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.sale.register'))
                        <a href="{{ Route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.sale.register') }}" class="button-register-sale pt-2 pe-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="{{ trans('cafeto::sales.TooltipRegisterSale') }}">
                            <i class="fa-solid fa-cart-shopping fa-bounce"></i>
                        </a>
                    @endif
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('cafeto::layouts.partials.controlSidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('cafeto::layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('cafeto::layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
