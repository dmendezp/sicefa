<!DOCTYPE html>
<html lang="en">
@include('pqrs::layouts.partials.head')

@section('stylesheet')
@show

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
  @include('pqrs::layouts.partials.navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  @include('pqrs::layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('pqrs::layouts.partials.breadcrumb')
    <!-- /.content-header -->
    <!-- Main content -->
    @section('content')
    @show
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  @include('pqrs::layouts.partials.footer')
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
@include('pqrs::layouts.partials.scripts')

@section('script')
@show

</body>
</html>
