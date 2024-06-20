<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-lg-inline-block">
        <a href="{{ route('cefa.pqrs.home.index') }}" class="nav-link">{{ trans('sica::menu.Home') }}</a>
      </li>

      @if (auth()->check() && checkRol('pqrs.tracking'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pqrs.tracking.index') }}" role="button">
            {{ trans('pqrs::tracking.tracking') }}
          </a>
        </li>
      @endif
      
      @if (auth()->check() && checkRol('pqrs.official'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pqrs.official.answer.index') }}" role="button">
            {{ trans('pqrs::tracking.official') }}
          </a>
        </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <a href="{{ route ('cefa.pqrs.home.manual')}}" class="nav-link" id="question">
        <i class="fas fa-question-circle"></i>
      </a>   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
       <!-- languaje Dropdown Menu-->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            {{ session('lang') }} <i class="fas fa-globe"></i>
        </a>
        <div class="dropdown-menu p-0">
            <a href="{{ url('lang', ['es']) }}" class="dropdown-item">
                Español
            </a>
            <a href="{{ url('lang', ['en']) }}" class="dropdown-item">
                Inglés
            </a>
        </div>
    </li>
    </ul>
</nav>