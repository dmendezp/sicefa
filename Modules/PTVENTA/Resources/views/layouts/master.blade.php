<!DOCTYPE html>
<html lang="es">

    @include('ptventa::layouts.partials.head')

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
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb') @show
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
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
                <div class="os-padding">
                    <div class="os-viewport os-viewport-native-scrollbars-invisible">
                        <div class="os-content" style="padding: 16px; height: auto; width: 100%;">
                            <h5>Herramientas rápidas</h5>
                            <hr class="mb-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                                <li class="nav-item">

                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Link</p>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('ptventa::layouts.partials.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('ptventa::layouts.partials.scripts')

    @section('scripts') @show
</body>
</html>
