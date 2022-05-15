<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punto de venta</title>
    @include('ptoventa::layouts.partials.head')
   
       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/ptoventa.css') }}"> --}}

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('ptoventa::layouts.partials.navbar')
        @include('ptoventa::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12" id="breadvar" style="background: #3d79aa;" >
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"> {{ trans('ptoventa::menu.Home') }}</a></li>
                        @section('breadcrumb')
                        @show 
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>
            <!-- /.content-header -->
            <!-- Main content -->
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
              setTimeout(function(){
              $('.alert').slideUp();
            }, 10000);
          </script>
          </div>
        </div>
        @endif
            <div class="content">
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->

          {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/ptoventa.js') }}"></script> --}}
          <script src="{{ mix('js/app.js') }}"></script>
       
        @include('ptoventa::layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('ptoventa::layouts.partials.scripts')
    @section('js')
    @show
</body>

</html>