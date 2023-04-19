<!DOCTYPE html>
<html lang="en">
<head>
  @include('ganaderia::layouts.partials.head')
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('ganaderia::layouts.partials.navbar')
    @include('ganaderia::layouts.partials.sidebar')
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12" id="breadvar">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href=""><i class="fas fa-map-marked-alt"></i> {{ __('ganaderia') }}</a></li>
                @section('breadcrumb')
                @show
              </ol>
            </div>
          </div>
        </div>
      </div>
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
      @section('content')
      @show
    </div>
    @include('ganaderia::layouts.partials.footer')
  </div>

  @include('ganaderia::layouts.partials.scripts')

  @section('script')
  @show

</body>
</html>