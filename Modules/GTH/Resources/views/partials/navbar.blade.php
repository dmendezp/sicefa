<nav class="navbar">
  <button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>

  <div class="navbar-links">
      <a href="{{route('cefa.index.view')}}" class="navbar-link" id="inicio">{{ trans('gth::menu.Home') }}</a>
      <a href="{{route('cefa.attendance.view')}}" class="navbar-link" id="inicio"><i class='bx bx-list-check icon'></i>{{ trans('gth::menu.Attendance') }}</a>
      <a href="{{ url('lang', ['en']) }}" class="navbar-link" style="margin-right: 60px;"><i class="bi bi-globe icon"></i>{{ trans('gth::menu.English') }}</a>
      <a href="{{ url('lang', ['es']) }}" class="navbar-link" style="margin-right: 120px;"><i class="bi bi-translate icon"></i>{{ trans('gth::menu.Spanish') }}</a>
      <a href="{{route('login')}}" class="navbar-link" style="margin-left: 150px;"><i class='bx bx-lock icon'></i>{{ trans('gth::menu.Login') }}</a>
   </div>
</nav>