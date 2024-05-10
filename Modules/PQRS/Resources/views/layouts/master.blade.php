<!DOCTYPE html>

<html lang="en">
    @include('pqrs::layouts.partials.head')
    @section('stylesheet')
    @show
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('pqrs::layouts.partials.navbar')
  <!-- /.navbar -->
  

  <!-- Main Sidebar Container -->
  

    <!-- Sidebar -->
    @include('pqrs::layouts.partials.sidebar')
    <!-- /.sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('pqrs::layouts.partials.breadcrum')
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

@include('pqrs::layouts.partials.scripst')

@section('script')
@show

</body>
</html>
