<nav class="main-header navbar navbar-expand navbar-dark bg-success">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('cefa.hdc.index') }}"class="nav-link">{{ trans('hdc::hdcgeneral.Home')}}</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link ">{{ trans('hdc::hdcgeneral.administrator')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link ">{{ trans('hdc::hdcgeneral.user')}}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="nav-icon fa-solid fa-globe"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('lang',['es'])}}" class="nav-link ">{{ trans('hdc::hdcgeneral.Spanish')}}</a>
                <a class="dropdown-item"  href="{{url('lang',['en'])}}" class="nav-link">{{ trans('hdc::hdcgeneral.English')}}</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <div type="button" class="btn btn-success">
                @guest
                    <a href="{{ route('login') }}" class="text-decoration-none text-black">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                @else
                    <span>{{ Auth::user()->person->fullname }}</span>
                @endguest
            </div>
        </li>
        <!-- <li class="nav-item" title="Salir">
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
      @csrf
      <button type="submit" class="btn btn-outline nav-link"><i class="fas fa-sign-out-alt" ></i></button>
      </form> -->
        </li>
    </ul>
</nav>