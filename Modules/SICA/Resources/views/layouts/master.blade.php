<!DOCTYPE html>
<html lang="en">
@include('sica::layouts.partials.head')

@section('stylesheet')
@show

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
    @include('sica::layouts.partials.navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
    @include('sica::layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('sica::layouts.partials.breadcrumb')
    <!-- /.content-header -->
    <!-- Main content -->
    @section('content')
    @show
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
    @include('sica::layouts.partials.footer')
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
@include('sica::layouts.partials.scripts')

@section('script')
@show

</body>
</html>
