<nav id="primary-menu" class="navbar navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
            <ul class="nav navbar-nav nav-pos-right navbar-left">
                <!-- Aquí puedes integrar el contenido de tu menú SIA adaptando las rutas y traducciones según tu módulo -->
                <!-- Ejemplo de Home público -->
                @if (Route::is('cefa.sia.*'))
                    <li class="has-dropdown mega-dropdown active">
                        <a href="{{ route('cefa.sia.index') }}" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-house"></i> {{ trans('sia::general.MainPage') }}</a>
                    </li>
                @endif
                <!-- Home Administrador -->
                @if (Route::is('sia.admin.*'))
                    @if (Auth::user()->havePermission('sia.admin.index'))
                        <li class="has-dropdown mega-dropdown active">
                            <a href="{{ route('sia.admin.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('sia::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif
                <!-- Home Instructor Investigador -->
                @if (Route::is('sia.instructor.*'))
                    @if (Auth::user()->havePermission('sia.instructor.index'))
                        <li class="has-dropdown mega-dropdown active">
                            <a href="{{ route('sia.instructor.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('sia::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif
                <!-- Home Aprendiz Investigador -->
                @if (Route::is('sia.apprentice.*'))
                    @if (Auth::user()->havePermission('sia.apprentice.index'))
                        <li class="has-dropdown mega-dropdown active">
                            <a href="{{ route('sia.apprentice.index') }}" class="dropdown-toggle menu-item"><i
                                    class="fa-solid fa-house"></i> {{ trans('sia::general.MainPage') }}</a>
                        </li>
                    @endif
                @endif

                <!-- Menú de opciones públicas -->
                @if (Route::is('cefa.sia.*'))
                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"
                            data-hover="shop">{{ trans('sia::general.Information') }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('cefa.sia.info') }}">
                                    <i class="fa-solid fa-info"></i> {{ trans('sia::general.AboutUs') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cefa.sia.devs') }}">
                                    <i class="fa-solid fa-code"></i> {{ trans('sia::general.Developers') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Menú de opciones para administrador -->
                @if (Route::is('sia.admin.*'))
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                                class="fa-solid fa-sitemap"></i> {{ trans('sia::general.Administration') }}</a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li>
                                    <!-- Column #1: Gestión de Proyectos -->
<div class="col-md-3">
    <a href="#">{{ trans('sia::general.Projects') }}</a>
    <ul>
        @if (
            Auth::user()->havePermission('sia.admin.research_project.index') ||
            Auth::user()->havePermission('sia.admin.research_project.store') ||
            Auth::user()->havePermission('sia.admin.research_project.update') ||
            Auth::user()->havePermission('sia.admin.research_project.destroy')
        )
            <li>
                <a href="{{ route('sia.admin.research_project.index') }}">
                    <i class="fa-solid fa-project-diagram"></i>
                    {{ trans('sia::general.Projects') }}
                </a>
            </li>
        @endif
    </ul>
</div>
                                      <!-- Column: Gestión de Publicaciones -->
<div class="col-md-3">
    <a href="#">{{ trans('sia::general.Posts') }}</a>
    <ul>
        @if (
            Auth::user()->havePermission('sia.admin.publication.index') ||
            Auth::user()->havePermission('sia.admin.publication.store') ||
            Auth::user()->havePermission('sia.admin.publication.update')
        )
            <li>
                <a href="{{ route('sia.admin.publication.index') }}">
                    <i class="fa-solid fa-newspaper"></i>
                    {{ trans('sia::general.Posts') }}
                </a>
            </li>
        @endif
    </ul>
</div>

<!-- Column: Gestión de Eventos -->
<div class="col-md-3">
    <a href="#">{{ trans('sia::general.Events') }}</a>
    <ul>
        @if (
            Auth::user()->havePermission('sia.admin.event.index') ||
            Auth::user()->havePermission('sia.admin.event.store') ||
            Auth::user()->havePermission('sia.admin.event.update') ||
            Auth::user()->havePermission('sia.admin.event.destroy')
        )
            <li>
                <a href="{{ route('sia.admin.event.index') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    {{ trans('sia::general.Events') }}
                </a>
            </li>
        @endif
    </ul>
</div>
                                       <!-- Column: Gestión de Alianzas -->
<div class="col-md-3">
    <a href="#">{{ trans('sia::general.Alliances') }}</a>
    <ul>
        @if (
            Auth::user()->havePermission('sia.admin.alliance.index') ||
            Auth::user()->havePermission('sia.admin.alliance.store') ||
            Auth::user()->havePermission('sia.admin.alliance.update') ||
            Auth::user()->havePermission('sia.admin.alliance.destroy')
        )
            <li>
                <a href="{{ route('sia.admin.alliance.index') }}">
                    <i class="fa-solid fa-handshake"></i>
                    {{ trans('sia::general.Alliances') }}
                </a>
            </li>
        @endif
    </ul>
</div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Mode User -->
                @guest
                @else
                    @auth
                        @if (checkRol('sia.admin'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('sia.admin.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('sia::general.ModeA') }}</a>
                            </div>
                        @endif
                        @if (checkRol('sia.inst-inv'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('sia.instructor.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('sia::general.ModeI') }}</a>
                            </div>
                        @endif
                        @if (checkRol('sia.ap-inv'))
                            <div class="module module-reservation pull-left">
                                <a href="{{ route('sia.apprentice.index') }}" class="btn-popup btn-popup-theme">
                                    {{ trans('sia::general.ModeAp') }}</a>
                            </div>
                        @endif
                    @endauth
                @endguest

                <!-- Menu Session-->
                <li class="has-dropdown">
                    @guest
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">{{ trans('sia::general.Log In') }}</a>
                    @else
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">
                            {{ Auth::user()->person->fullname }} <i class="fa-solid fa-angles-down"></i>
                        </a>
                    @endguest
                    <ul class="dropdown-menu">
                        @guest
                            <li>
                                <a class="menu-item" href="{{ route('login', ['redirect' => url()->current()]) }}">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ trans('sia::general.Log In') }}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('cefa.welcome') }}">
                                    <i class="nav-icon fas fa-puzzle-piece"></i> {{ trans('sia::general.Back to SICEFA') }}
                                </a>
                            </li>
                        @else
                            @auth
                                @if (checkRol('sia.admin'))
                                    <li>
                                        <a href="{{ route('sia.admin.index') }}" class="menu-item">
                                            <i class="fa-solid fa-user-tie"></i> {{ trans('sia::general.ModeA') }}
                                        </a>
                                    </li>
                                @endif
                                @if (checkRol('sia.inst-inv'))
                                    <li>
                                        <a href="{{ route('sia.instructor.index') }}" class="menu-item">
                                            <i class="fa-solid fa-chalkboard-teacher"></i> {{ trans('sia::general.ModeI') }}
                                        </a>
                                    </li>
                                @endif
                                @if (checkRol('sia.ap-inv'))
                                    <li>
                                        <a href="{{ route('sia.apprentice.index') }}" class="menu-item">
                                            <i class="fa-solid fa-user-graduate"></i> {{ trans('sia::general.ModeAp') }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('cefa.sia.index') }}" class="menu-item">
                                        <i class="fa-regular fa-user"></i> {{ trans('sia::general.ModeU') }}
                                    </a>
                                </li>
                            @endauth
                            <li>
                                <a class="menu-item" href="{{ route('cefa.welcome') }}">
                                    <i class="nav-icon fas fa-puzzle-piece"></i> {{ trans('sia::general.Back to SICEFA') }}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ trans('sia::general.Logout') }} 
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </li>
                <!-- Menu Lang-->
                <li class="has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item"><i
                            class="fas fa-globe-americas"></i> {{ session('lang') }}</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('lang', ['en']) }}" class="menu-item">
                                <img src="{{ asset('modules/sia/images/flags/estados-unidos.webp') }}"
                                    alt="" width="20px">
                                    {{ trans('sia::general.English') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('lang', ['es']) }}" class="menu-item">
                                <img src="{{ asset('modules/sia/images/flags/colombia.webp') }}" alt=""
                                    width="20px">
                                    {{ trans('sia::general.Spanish') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>   