<nav class="main-header navbar navbar-expand navbar-dark navbar-lightorange">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('cefa.cpd.home') }}"
                class="nav-link {{ !Route::is('cefa.cpd.home') ?: 'active' }}">{{ trans('cpd::general.Home') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @if (session('lang') != 'en')
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
                        alt="User Image" style="width: 20px; height: 20px;"> {{ trans('cpd::general.English') }}
                </a>
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                    <img src="{{ asset('general/images/colombia_r.svg') }}" class="icon-bar" alt="User Image"
                        style="width: 20px; height: 20px;"> {{ trans('cpd::general.Spanish') }}
                </a>
            </div>
        </li>
    </ul>
</nav>
