<!DOCTYPE html>
<html lang="en">
@include('gth::partials.head')

@section('stylesheet')
@show

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        @include('gth::partials.navbar')

        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @if (Auth::user()->havePermission('gth.registerattendance.attendancecourse.index'))
            @include('gth::partials.asistenciasidebar')
        @elseif (Auth::user()->havePermission('gth.brigadista.attendancereport.index'))
            @include('gth::partials.asistenciasidebar')
        @elseif (in_array(request()->path(), ['gth/attendanceregister','gth/attendanceregister']))
            @include('gth::partials.asistenciasidebar')
        @elseif (in_array(request()->path(), ['gth/attendancereport']))
            @include('gth::partials.asistenciasidebar')
        @else
            @include('gth::partials.sidebar')
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('gth::partials.breadcrumb')
            <!-- /.content-header -->
            <!-- Main content -->
            @section('content')
            @show
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        @include('gth::partials.footer')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @include('gth::partials.scripts')

    @section('scripts')
    @show

</body>

</html>
