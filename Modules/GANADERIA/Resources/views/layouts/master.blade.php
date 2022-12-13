<!DOCTYPE html>
<html lang="en">
<head>
    @include('ganaderia::layouts.partials.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
    @include('ganaderia::layouts.partials.navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
    @include('ganaderia::layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12" id="breadvar">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=""><i class="fas fa-hat-cowboy"></i> {{ __('Ganaderia') }}</a></li>
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
    <!-- /.content-header -->

    <!-- Main content -->
@section('content')

@show
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
    @include('ganaderia::layouts.partials.footer')
</div>
<!-- ./wrapper -->
</body>
</html>
