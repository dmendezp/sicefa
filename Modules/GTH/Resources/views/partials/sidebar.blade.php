<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('cefa.index.view') }}" class="brand-link">
        <img src="{{ asset('modules/gth/images/logo.png') }}" alt="GTH Logo" class="brand-image " style="opacity: .8">
        <span class="brand-text h3">GTH</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('senaempresa::menu.Welcome') }}</div>
                        <div><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Login') }}"><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block"><i
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
                        title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block"
                            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt"></i></a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>

        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('cefa.welcome') }}"
                            class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="nav-icon fas fa-puzzle-piece"></i>
                            <p>
                                {{ trans('sica::menu.Back to') }} {{ env('APP_NAME') }}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('cefa.index.view') }}"
                        class="nav-link {{ !Route::is('cefa.index.view') ?: 'active' }}">
                        <i class="fas fa-home"></i>
                        <p> {{ trans('gth::menu.Home') }}</p>
                    </a>
                </li>
                @if (Route::is('gth.admin.*') || Route::is('cefa.contractualcertificate.*'))
                <li
                        class="nav-item {{ Route::is('gth.admin.insurerentities.index', 'gth.admin.contractortypes.index', 'gth.admin.employeetypes.index', 'gth.admin.pensionentities.index', 'gth.admin.position.index') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ !Route::is('contratos.*') ?: 'active' }}">
                            <i class="fas fa-users-cog"></i>
                            <p>{{ trans('gth::menu.Configuration') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->havePermission('gth.admin.insurerentities.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.insurerentities.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.insurerentities.index') ?: 'active' }}">
                                    <i class="fas fa-newspaper"></i>
                                    <p>
                                        {{ trans('gth::menu.Insurance Company') }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            @if (Auth::user()->havePermission('gth.admin.contractortypes.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.contractortypes.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.contractortypes.index') ?: 'active' }}">
                                    <i class="far fa-clipboard"></i>
                                    <p>
                                        {{ trans('gth::menu.Type of Contract') }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            @if (Auth::user()->havePermission('gth.admin.employeetypes.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.employeetypes.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.employeetypes.index') ?: 'active' }}">
                                    <i class="fas fa-puzzle-piece"></i>
                                    <p>
                                        {{ trans('gth::menu.Type of Employee') }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            @if (Auth::user()->havePermission('gth.admin.pensionentities.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.pensionentities.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.pensionentities.index') ?: 'active' }}">
                                    <i class="fas fa-user-edit"></i>
                                    <p>
                                        {{ trans('gth::menu.Pension') }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            @if (Auth::user()->havePermission('gth.admin.position.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.position.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.position.index') ?: 'active' }}">
                                    <i class="fas fa-envelope-open-text"></i>
                                    <p>
                                        {{ trans('gth::menu.Grades') }}
                                    </p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ !Route::is('contratos.*') ?: 'active' }}">
                            <i class="fas fa-file-signature"></i>
                            <p>{{ trans('gth::menu.Contracts') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->havePermission('gth.admin.contractreports.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.contractreports.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.contractreports.index') ?: 'active' }}">
                                    <i class="fas fa-file-alt"></i>
                                    <p> {{ trans('gth::menu.Employment Contract') }}</p>
                                </a>
                            </li>
                            @endif

                            @if (Auth::user()->havePermission('gth.admin.contractors.index'))
                            <li class="nav-item">
                                <a href="{{ route('gth.admin.contractors.index') }}"
                                    class="nav-link {{ !Route::is('gth.admin.contractors.index') ?: 'active' }}">
                                    <i class="fas fa-file-contract"></i>
                                    <p>
                                        {{ trans('gth::menu.Contract Report') }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a href="{{ route('cefa.contractualcertificate.view') }}"
                                    class="nav-link {{ !Route::is('cefa.contractualcertificate.view') ?: 'active' }}">
                                    <i class="fas fa-receipt"></i>
                                    <p>
                                        {{ trans('gth::menu.Contract Certificate') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->havePermission('gth.admin.officials.index'))
                    <li class="nav-item">
                        <a href="{{ route('gth.admin.officials.index') }}"
                            class="nav-link {{ !Route::is('gth.admin.officials.index') ?: 'active' }}">
                            <i class="fas fa-street-view"></i>
                            <p>
                                {{ trans('gth::menu.Officials') }}
                            </p>
                        </a>
                    </li>
                    @endif
                @endif
                

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
