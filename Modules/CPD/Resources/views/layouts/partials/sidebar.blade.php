<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.cpd.home') }}" class="brand-link">
        <img src="{{ asset('cpd/images/logo.png') }}" alt="CPD Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <b>CPD</b>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if(isset(Auth::user()->person->avatar))
                        @if (file_exists(asset('storage/'.Auth::user()->person->avatar)))
                            <img src="{{ asset('storage/'.Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('cpd/images/user-white.png') }}" class="img-circle elevation-2" alt="User Image">
                        @endif
                    @else
                        <img src="{{ asset('cpd/images/user-white.png') }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>

                @guest
                    <div class="col info info-user">
                        <div>{{ trans('menu.Welcome') }}</div>
                            <div>
                                <a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a>
                            </div>
                        </div>
                        <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}">
                            <a href="{{ route('login') }}" class="d-block" >
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        </div>
                @else
                        <div class="col info info-user">
                            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
                            <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
                        </div>
                        <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
                            <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>

        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('cefa.welcome') }}" class="nav-link">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ trans('sica::menu.Back to') }} {{ env('APP_NAME') }}</p>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @auth
                    <li class="nav-item">
                        <a href="{{ route('cpd.admin.study.index') }}" class="nav-link  @if (strpos(Route::currentRouteName(), '.study.')) active @endif">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Monitoreos</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cpd.admin.producer.index') }}" class="nav-link  @if (strpos(Route::currentRouteName(), '.producer.')) active @endif">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>Productores</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('cefa.cpd.metadata.index') }}" class="nav-link  @if (strpos(Route::currentRouteName(), '.metadata')) active @endif">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Metadatos</p>
                        </a>
                    </li>
                @endauth

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
