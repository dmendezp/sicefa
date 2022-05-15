<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-lightblue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('cefa.ptoventa.index')}}" class="nav-link">{{ trans('ptoventa::menu.Home') }}</a>
        </li>
        @guest
        @else
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('ptoventa.admin.dashboard')}}" class="nav-link">{{
                trans('ptoventa::menu.Administrator') }}</a>
        </li>

        @endguest
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Language Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @if(session('lang')!='en')
                <img src="{{ asset('general/images/colombia_r.svg') }}" class="icon-bar" alt="User Image"
                    style="width: 20px; height: 20px;">
                @else
                <img src="{{ asset('general/images/estados-unidos-de-america_r.svg') }}" class="icon-bar"
                    alt="User Image" style="width: 20px; height: 20px;">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                    <img src="{{ asset('general/images/estados-unidos-de-america_r.svg') }}" class="icon-bar"
                        alt="User Image" style="width: 20px; height: 20px;"> English
                </a>
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                    <img src="{{ asset('general/images/colombia_r.svg') }}" class="icon-bar" alt="User Image"
                        style="width: 20px; height: 20px;"> Español
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">12 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Yogurt de cafe vencido
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 Nectar vencidos
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 Salchichones vencidos
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->