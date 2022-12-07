<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">

    <!-- Brand Logo -->
    <a href="{{route('index')}}" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sena Empresa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">


            <div class="image mt-2 mb-2">
                @if(isset(Auth::user()->person->avatar))
                <img src="{{ asset('storage/'.Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            @guest
            <div class="col info info-user">
                <div>{{ trans('menu.Welcome') }}</div>
                <div><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>

            </div>
            <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block"><i
                        class="fas fa-sign-in-alt"></i></a>
            </div>
            @else
            <div class="col info info-user">
                <div data-toggle="tooltip" data-placement="top"
                    title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                    {{ Auth::user()->nickname }}</div>
                <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
            </div>
            <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endguest
       




    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Turnos
                        <i class="right fas fa-angle-left "></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('turnosRutinarios')}}" class="nav-link {{ ! Route::is('turnosRutinarios') ?: 'active' }}">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>Turnos Rutinarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link inactive">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inactive Page</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>



        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>