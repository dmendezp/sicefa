<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-lg-inline-block">
        <a href="{{ route('cefa.pqrs.home.index') }}" class="nav-link">{{ trans('sica::menu.Home') }}</a>
      </li>
      
      @if (checkRol('official'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pqrs.official.answer.index') }}" role="button">
            Funcionario
          </a>
        </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
</nav>