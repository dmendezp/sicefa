<!DOCTYPE html>
<html lang="es">
    <head>
        @include('tilabs::layouts.partials.head')
        @section('stylesheet')
        @show
    </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('tilabs::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('tilabs::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('tilabs::layouts.partials.breadcrumb')
            @section('content') 
            @show
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('tilabs::layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('tilabs::layouts.partials.scripts')
</body>

</html>
