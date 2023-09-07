<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
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
                  setTimeout(function() {
                    $('.alert').slideUp();
                  }, 10000);
                </script>
              </div>
            </div>
            @endif
            @yield('content')
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->