<body style="background-color: #e4e9f7 ">
    <div class="navbar" style="justify-content: initial">
        @if (Auth::check())
            <ul>
                @if (!empty(Session::get('selectedUnitName')))
                <li style="margin-left: 5px; margin-right: 30px; width: 280px">
                    <a href="#" id="an2">
                        <a href="#" id="an2">
                            AGROCEFA|{{ Session::get('selectedUnitName') }}
                        </a>
                    </a>
                </li>
                @else
                <li style="margin-left: 5px; margin-right: 200px; width: 280px">
                    <a href="#" id="an2">
                        AGROCEFA
                    </a>
                </li>
                @endif
                    @if (checkRol('superadmin'))    
                        @if (checkRol('agrocefa.trainer'))
                            <li style="margin-right: 20px">
                                <a href="{{ route('agrocefa.trainer.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.trainer.*')) active @endif">Instructor</a>
                            </li>
                        @endif
                        @if (checkRol('agrocefa.passant'))
                            <li style="margin-right: 20px">
                                <a href="{{ route('agrocefa.passant.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.passant.*')) active @endif">Pasante</a>
                            </li>
                        @endif
                        @if (checkRol('agrocefa.manageragricultural'))
                            <li style="margin-right: 20px">
                                <a href="{{ route('agrocefa.manageragricultural.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.manageragricultural.*')) active @endif">Gestor</a>
                            </li>
                        @endif
                        
                        <li style="margin-right: 50px"><a href="{{ route('cefa.agrocefa.index') }}"
                                id="an">{{ trans('agrocefa::universal.Home') }}</a></li>
                        <div class="dropdown" style="margin-right: 20px">
                            <a class="nav-link scrollto" data-toggle="dropdown" href="#" style="width: 70px" id="an">
                                {{ session('lang') }} <i class="fas fa-globe" id="an"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ url('lang',['es']) }}" class="dropdown-item scrollto">Español</a>
                                <a href="{{ url('lang',['en']) }}" class="dropdown-item scrollto">English</a>
                            </div>
                        </div>
                        @if (!checkRol('superadmin') )
                            @if (checkRol('agrocefa.trainer') || checkRol('agrocefa.manageragricultural'))
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.notification') && Route::currentRouteName() != 'agrocefa.passant.index' && Route::currentRouteName() != 'agrocefa.trainer.index' && Route::currentRouteName() != 'cefa.agrocefa.index' && Route::currentRouteName() != 'cefa.agrocefa.developers.index' && Route::currentRouteName() != 'cefa.agrocefa.usuario.index')
                                    <li style="width: 60px">
                                        <a href="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.notification')}}" id="an" title="Ver Movimientos Pendientes">
                                            <i class="fa-regular fa-bell fa-flip"></i>
                                            @if (Session::has('notification') && Session::get('notification') > 0)
                                                <span class="notification-badge">{{ Session::get('notification') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.stock') && Route::currentRouteName() != 'agrocefa.passant.index' && Route::currentRouteName() != 'agrocefa.trainer.index' && Route::currentRouteName() != 'cefa.agrocefa.index' && Route::currentRouteName() != 'cefa.agrocefa.developers.index' && Route::currentRouteName() != 'cefa.agrocefa.usuario.index')
                                    <li style="width: 60px">
                                        <a href="{{ route('agrocefa.manageragricultural.inventory.stock')}}" id="an" title="Ver Elementos por Agotarse">
                                            <i class='bx bx-error-circle' ></i>
                                            @if (Session::has('notificationstock') && Session::get('notificationstock') > 0)
                                                <span class="notification-badge">{{ Session::get('notificationstock') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <div class="profile" style="margin-left: 10px; margin-right: 20px;">
                                        <div class="user-info">
                                            <div class="profile-img-container">
                                                @auth
                                                    @if (isset(Auth::user()->person->avatar))
                                                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"
                                                            class="profile-img img-circle elevation-2" alt="User Image">
                                                    @else
                                                        <img src="{{ asset('modules/agrocefa/images/general/user.png') }}"
                                                            class="profile-img img-circle elevation-2" alt="User Image">
                                                    @endif
                                                @endauth
                                            </div>
                                            <div class="profile-text" style="text-align: center;">
                                                @auth
                                                    <a href="#" class="profile-link" data-toggle="tooltip" data-placement="top"
                                                        title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                                                        {{ Auth::user()->nickname }}
                                                    </a>
                                                    <em class="profile-role">{{ Session::get('selectedRole') }}</em>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif 
                        @endif
                    @endif
                    @if (!checkRol('superadmin') )
                        @if (checkRol('agrocefa.trainer') || checkRol('agrocefa.passant') || checkRol('agrocefa.manageragricultural'))
                        @if (checkRol('agrocefa.trainer'))
                            <li style="margin-right: 80px">
                                <a href="{{ route('agrocefa.trainer.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.trainer.*')) active @endif">Instructor</a>
                            </li>
                        @endif
                        @if (checkRol('agrocefa.passant'))
                            <li style="margin-right: 80px">
                                <a href="{{ route('agrocefa.passant.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.passant.*')) active @endif">Pasante</a>
                            </li>
                        @endif
                        @if (checkRol('agrocefa.manageragricultural'))
                            <li style="margin-right: 80px">
                                <a href="{{ route('agrocefa.manageragricultural.index') }}" id="an"
                                    class="nav @if (Route::is('agrocefa.manageragricultural.*')) active @endif">Gestor</a>
                            </li>
                        @endif
                        @endauth
                        <li style="margin-right: 70px"><a href="{{ route('cefa.agrocefa.index') }}"
                                id="an">{{ trans('agrocefa::universal.Home') }}</a></li>
                        <div class="dropdown" style="margin-right: 40px">
                            <a class="nav-link scrollto" data-toggle="dropdown" href="#" style="width: 70px" id="an">
                                {{ session('lang') }} <i class="fas fa-globe" id="an"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ url('lang',['es']) }}" class="dropdown-item scrollto">Español</a>
                                <a href="{{ url('lang',['en']) }}" class="dropdown-item scrollto">English</a>
                            </div>
                        </div>
                        @if (checkRol('agrocefa.trainer') || checkRol('agrocefa.manageragricultural'))
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.notification') && Route::currentRouteName() != 'agrocefa.passant.index' && Route::currentRouteName() != 'agrocefa.trainer.index' && Route::currentRouteName() != 'cefa.agrocefa.index' && Route::currentRouteName() != 'cefa.agrocefa.developers.index' && Route::currentRouteName() != 'cefa.agrocefa.usuario.index')
                                <li style="width: 60px">
                                    <a href="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.notification')}}" id="an" title="Ver Movimientos Pendientes">
                                        <i class="fa-regular fa-bell fa-flip"></i>
                                        @if (Session::has('notification') && Session::get('notification') > 0)
                                            <span class="notification-badge">{{ Session::get('notification') }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.stock') && Route::currentRouteName() != 'agrocefa.passant.index' && Route::currentRouteName() != 'agrocefa.trainer.index' && Route::currentRouteName() != 'cefa.agrocefa.index' && Route::currentRouteName() != 'cefa.agrocefa.developers.index' && Route::currentRouteName() != 'cefa.agrocefa.usuario.index')
                                <li style="width: 0px">
                                    <a href="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.stock')}}" id="an" title="Ver Elementos por Agotarse">
                                        <i class='bx bx-error-circle' ></i>
                                        @if (Session::has('notificationstock') && Session::get('notificationstock') > 0)
                                            <span class="notification-badge">{{ Session::get('notificationstock') }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif

                            <li>
                                <div class="profile" style="margin-left: 50px; margin-right: 50px;">
                                    <div class="user-info">
                                        <div class="profile-img-container">
                                            @auth
                                                @if (isset(Auth::user()->person->avatar))
                                                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"
                                                        class="profile-img img-circle elevation-2" alt="User Image">
                                                @else
                                                    <img src="{{ asset('modules/agrocefa/images/general/user.png') }}"
                                                        class="profile-img img-circle elevation-2" alt="User Image">
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="profile-text" style="text-align: center;">
                                            @auth
                                                <a href="#" class="profile-link" data-toggle="tooltip" data-placement="top"
                                                    title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                                                    {{ Auth::user()->nickname }}
                                                </a>
                                                <em class="profile-role">{{ Session::get('selectedRole') }}</em>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endif
                    
                    
        @else
            <ul>
                <li style="margin-left: 40px;margin-right: 200px"><a href="#" id="an">AGROCEFA</a></li>
                <li style="margin-right: 400px"><a href="{{ route('cefa.agrocefa.index') }}"
                        id="an">{{ trans('agrocefa::universal.Home') }}</a></li>
                <li style="margin-right: 40px"><a href="{{ url('lang', ['en']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('modules/agrocefa/images/general/en.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English') }}</a></li>
                <li style="margin-right: 40px"><a href="{{ url('lang', ['es']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('modules/agrocefa/images/general/es.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish') }}</a></li>
            </ul>
        @endif
        
        @auth
            <a style="margin-left: 0px" href="{{ route('logout') }}" id="logout" title="Salir" class="logout-icon"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </ul>
        @endauth
    </div>
</div>


@yield('selectproductive')
</body>
<style>
    body {
        background-color: #e4e9f7;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        
        
    }

    .navbar ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar li {
        margin-right: 20px;
    }

    .profile {
        display: flex;
        align-items: center;
    }

    .profile-img-container {
        margin-right: 10px;
    }

    /* Agregar estilos para dispositivos pequeños */
    @media screen and (max-width: 968px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar ul {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }

        .navbar li {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .profile {
            margin-top: 10px;
        }
    }
</style>
