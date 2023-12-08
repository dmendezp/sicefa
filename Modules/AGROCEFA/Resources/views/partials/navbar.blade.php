<body style="background-color: #e4e9f7 ">
    <div class="navbar">
        @if (Auth::check())
            <ul>
                <li style="margin-left: 40px; margin-right: 50px">
                    <a href="#" id="an">
                        @if (!empty(Session::get('selectedUnitName')))
                            AGROCEFA-{{ Session::get('selectedUnitName') }}
                        @else
                            AGROCEFA
                        @endif
                    </a>
                </li>
                @auth
                    @if (checkRol('agrocefa.trainer'))
                        <li style="margin-right: 30px">
                            <a href="{{ route('agrocefa.trainer.index') }}" id="an"
                                class="nav-link @if (Route::is('agrocefa.trainer.*')) active @endif">Instructor</a>
                        </li>
                    @endif
                    @if (checkRol('agrocefa.passant'))
                        <li style="margin-right: 30px">
                            <a href="{{ route('agrocefa.passant.index') }}" id="an"
                                class="nav-link @if (Route::is('agrocefa.passant.*')) active @endif">Pasante</a>
                        </li>
                    @endif
                @endauth
                <li style="margin-right: 170px"><a href="{{ route('cefa.agrocefa.index') }}"
                        id="an">{{ trans('agrocefa::universal.Home') }}</a></li>
                <li style="margin-right: 40px"><a href="{{ url('lang', ['en']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('agrocefa/images/general/en.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English') }}</a></li>
                <li style="margin-right: 100px"><a href="{{ url('lang', ['es']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('agrocefa/images/general/es.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish') }}</a></li>
                @if (checkRol('agrocefa.trainer'))
                <li><a href="{{ route('agrocefa.trainer.movements.notification')}}" id="an"
                        title="Ver Movimientos Pendientes">
                        <i class="fa-regular fa-bell fa-flip"></i>
                        @if (Session::has('notification') && Session::get('notification') > 0)
                            <span class="notification-badge">{{ Session::get('notification') }}</span>
                        @endif
                    </a>
                </li>
                @endif

            </ul>
        @else
            <ul>
                <li style="margin-left: 40px;margin-right: 200px"><a href="#" id="an">AGROCEFA</a></li>
                <li style="margin-right: 400px"><a href="{{ route('cefa.agrocefa.index') }}"
                        id="an">{{ trans('agrocefa::universal.Home') }}</a></li>
                <li style="margin-right: 40px"><a href="{{ url('lang', ['en']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('agrocefa/images/general/en.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English') }}</a></li>
                <li style="margin-right: 40px"><a href="{{ url('lang', ['es']) }}" id="an"
                        class="dropdown-item"><img src="{{ asset('agrocefa/images/general/es.png') }}" alt=""
                            style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish') }}</a></li>

            </ul>
        @endif
        <div class="profile" style="margin-left: 20px; margin-right: 20px;">
            <div class="user-info">
                <div class="profile-img-container">
                    @auth
                        @if (isset(Auth::user()->person->avatar))
                            <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"
                                class="profile-img img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('agrocefa/images/general/user.png') }}"
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
            @auth
                <a href="{{ route('logout') }}" id="logout" title="Salir" class="logout-icon"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>
    </div>


    @yield('selectproductive')
</body>
