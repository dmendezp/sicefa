<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @auth
            @if(checkRol('superadmin') )
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('cefa.index.view') }}" class="nav-link">{{ trans('gth::menu.Home') }}</a>
                </li>
            @endif
            @if (checkRol('gth.admin'))
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('gth.admin.index') }}" class="nav-link ">{{ trans('gth::menu.Admin') }}
                </a>
            </li>
            @endif
                @if (Auth::user()->havePermission('gth.registerattendance.attendancecourse.index'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('gth.registerattendance.registerattendance.index') }}" class="nav-link ">{{ trans('gth::menu.Attendance') }}
                    </a>
                </li>
            @endif
                @if (Auth::user()->havePermission('gth.brigadista.attendancereport.index'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('gth.brigadista.attendancereport.index')}}" class="nav-link ">{{ trans('gth::menu.brigadista') }}
                    </a>
                </li>
            @endif
        @endauth

        <!--{{--
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('contacto')}}" class="nav-link">Contact</a>
    </li>
    --}}
    -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('cefa.usermanual.view')}}" role="button">
                <i class="fas fa-question-circle"></i>
            </a>
        </li>
        <!-- languaje Dropdown Menu-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ session('lang') }} <i class="fas fa-globe"></i>
            </a>

            <div class="dropdown-menu p-0">
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">{{ trans('gth::menu.Spanish') }}</a>
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">{{ trans('gth::menu.English') }}</a>
            </div>

        </li>


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- <li class="nav-item" title="Salir">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
    @csrf
    <button type="submit" class="btn btn-outline nav-link"><i class="fas fa-sign-out-alt" ></i></button>
    </form> -->

        </li>
    </ul>
</nav>
