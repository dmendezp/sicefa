<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block mx-1">
            <a href="#" class="nav-link">{{ trans('sigac::general.Home') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mx-1">
            <a class="nav-link" data-toggle="dropdown" href="#" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title={{ trans('sigac::general.Internacionalization') }}>
                <i class="fas fa-globe-americas"></i> {{ session('lang') }}
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                    <img src="{{ asset('modules/sigac/images/flags/estados-unidos.webp') }}" alt="">
                    {{ trans('sigac::general.LangEnglish') }}
                </a>
                <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                    <img src="{{ asset('modules/sigac/images/flags/colombia.webp') }}" alt="">
                    {{ trans('sigac::general.LangSpanish') }}
                </a>
            </div>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title={{ trans('sigac::general.Go') }}>
                <i class="fas fa-shapes"></i>
            </a>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title={{ trans('sigac::general.FullScreen') }}>
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
