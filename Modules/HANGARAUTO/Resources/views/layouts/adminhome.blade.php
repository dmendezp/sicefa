<!DOCTYPE html>
<html lang="es">
<head>
    @include('hangarauto::layout.partials.head')
</head>
<body>
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('hangarauto::layout.partials.adminnavbar')
            @include('hangarauto::layout.partials.adminsidebar')
            <div class="content-wrapper">
                <!--- Content Header (Page header) -->
                @if(Session::has('messages'))
                    <div class="container-fluid">
                        <div class="alert alert-{{Session::get('typealert') }}" role="alert">
                            {{Session::get('messages')}}
                            @if($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <script src="{{ asset('adminlte/plugins/jquery/jquery-3.6.0.min.js')}}"></script>
                            <script>
                                $('.alert').slideDown();
                                setTimeout(function(){$('.alert').slideUp();}, 8000)
                            </script>
                        </div>
                    </div>
                @endif
                @section('content')
                @show
            </div>
        </div>
        @section('js')
        @show
    </div>
</body>
</html>