<nav class="main-header navbar navbar-expand navbar-dark bg-primary">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('cefa.hangarauto.index') }}"class="nav-link">{{ trans('hangarauto::general.Home') }}</a>
        </li>
            
                @auth
                    @if (checkRol('hangarauto.admin'))
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('hangarauto.admin.index') }}" 
                                class="nav-link ">{{ trans('hangarauto::general.Administrator')}}</a>
                        </li>
                    @endif
                    @if (checkRol('hangarauto.charge'))
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('hangarauto.charge.index') }}" class="nav-link ">{{ trans('hangarauto::general.Charge')}}</a>
                        </li>
                    @endif
                    @if (checkRol('hangarauto.driver'))
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('hangarauto.driver.index') }}" class="nav-link ">Conductor</a>
                        </li>
                    @endif
                @endauth
            
        
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
                <li class="nav-item">
                    <a href="{{ route('cefa.instruction.manual') }}" class="nav-link"
                    title="{{ trans('hangarauto::general.instruction.manual') }}">
                        <i class="nav-icon fa-solid fa-book"></i>
                    </a>
                </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="nav-icon fa-solid fa-globe"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('lang', ['es']) }}"
                    class="nav-link ">{{ trans('hangarauto::general.Spanish') }}</a>
                <a class="dropdown-item" href="{{ url('lang', ['en']) }}"
                    class="nav-link">{{ trans('hangarauto::general.English') }}</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
       {{--   <li class="nav-item">
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
        </li>  --}}
    </ul>
</nav>
