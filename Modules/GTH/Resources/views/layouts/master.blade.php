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
    @include('gth::partials.sidebar')
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