<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')

@section('stylesheet')
@show

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('senaempresa::layouts.structure.breadcrumb')
            <!-- /.content-header -->
            <!-- Main content -->
            @section('content')
            @show
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        @include('senaempresa::layouts.structure.footer')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @include('senaempresa::layouts.structure.scripts')

    @section('scripts')
    @show

    @section('dataTables')
    @show

</body>

</html>
