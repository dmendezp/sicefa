<aside class="main-sidebar sidebar-dark-blue elevation-4">    
    <!-- Brand Logo: Ajuste del logo y título en el sidebar -->
    <a href="{{ route('cefa.tilabs.index') }}" class="brand-link text-decoration-none">
        <img src="{{ asset('modules/tilabs/images/house-laptop-solid.svg') }}" class="brand-image custom-icon" alt="TILABS-Logo"> {{-- Icono de TI-LABS --}}
        <span class="brand-text font-weight-bold">TI-LABS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            <div class="image">
                @if (isset(Auth::user()->person->avatar))
                    <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            @guest
                <div class="col info info-user">
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block custom-color" style="text-decoration: none">{{ trans('tilabs::general.Log In') }}</a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title={{ trans('tilabs::general.InSession') }}>
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </div>
            @else
                <div class="col info info-user">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                        <div style="color:white">{{ Auth::user()->nickname }}</div>
                    </div>
                    <div class="small" style="color:white">
                        <em>{{ Auth::user()->roles[0]->name }}</em>
                    </div>
                </div>
                <div class="col-auto info float-right mt-2">
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title={{ trans('tilabs::general.ExitSession') }} onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('cefa.welcome') }}" class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="nav-icon fas fa-puzzle-piece"></i>
                            <p>
                                {{ trans('tilabs::general.Back to SICEFA') }}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('cefa.tilabs.index') }}" class="nav-link {{ !Route::is('cefa.tilabs.index') ?: 'active' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            {{ trans('tilabs::general.Home') }}
                        </p>
                    </a>
                </li>

                @if (Route::is('tilabs.admin.*'))
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.dashboard') }}" class="nav-link {{ !Route::is('tilabs.admin.dashboard') ?: 'active' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                {{ trans('tilabs::general.dashboard') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.labs') }}" class="nav-link {{ !Route::is('tilabs.admin.labs') ?: 'active' }}">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                {{ trans('tilabs::general.Labs') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.inventory') }}" class="nav-link {{ !Route::is('tilabs.admin.inventory') ?: 'active' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                {{ trans('tilabs::general.Inventory') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.loan') }}" class="nav-link {{ !Route::is('tilabs.admin.loan') ?: 'active' }}">
                            <i class="nav-icon fas fa-share"></i>
                            <p>
                                {{ trans('tilabs::general.Loan') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.return') }}" class="nav-link {{ !Route::is('tilabs.admin.return') ?: 'active' }}">
                            <i class="nav-icon fas fa-reply"></i>
                            <p>
                                {{ trans('tilabs::general.Return') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tilabs.admin.transactions') }}" class="nav-link {{ !Route::is('tilabs.admin.transactions') ?: 'active' }}">
                            <i class="nav-icon fas fa-dolly-flatbed"></i>
                            <p>
                                {{ trans('tilabs::general.Movement') }}
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('cefa.tilabs.developers') }}" class="nav-link {{ !Route::is('cefa.tilabs.developers') ?: 'active' }}">
                        <i class="nav-icon fa-solid fa-code"></i>
                        <p>
                            {{ trans('tilabs::general.Developers') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cefa.tilabs.about') }}" class="nav-link {{ !Route::is('cefa.tilabs.about') ?: 'active' }}">
                        <i class="nav-icon fa-solid fa-info"></i>
                        <p>
                            {{ trans('tilabs::general.About us') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
