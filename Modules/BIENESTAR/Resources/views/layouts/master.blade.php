<!DOCTYPE html>
<html lang="en">
@include('bienestar::layouts.partials.head')

@section('stylesheet')
@show

<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <!-- Navbar -->
    @include('bienestar::layouts.partials.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('bienestar::layouts.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper with-background">
      <!-- Content Header (Page header) -->
      @include('bienestar::layouts.partials.breadcrumb')
      <!-- /.content-header -->
      <!-- Main content -->
      @show
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('bienestar::layouts.partials.footer')
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
  @include('bienestar::layouts.partials.scripts')

  @section('script')
  @show

</body>

</html>