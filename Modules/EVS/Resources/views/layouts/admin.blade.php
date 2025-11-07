<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('evs::layouts.partials.headadmin')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('evs::layouts.partials.navbaradmin')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('evs::layouts.partials.sidebaradmin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12" id="breadvar">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('evs.admin.dashboard') }}"><i class="fas fa-user-cog"></i> {{ __('Administrator') }}</a></li>
              @section('breadcrumb')
              @show
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        @if(Session::has('message'))
        <div class="container-fluid">
          <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: block; margin-bottom: 16px;">
          {{ Session::get('message') }}
          @if ($errors->any())
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif
          <script>
            $('.alert').slideDown();
            setTimeout(function(){$('.alert').slideUp();}, 10000);
          </script>
          </div>
        </div>
        @endif
    <!-- Main content -->
@section('content')

@show
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('evs::layouts.partials.footer')
</body>
</html>
