  <aside class="main-sidebar sidebar-light-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.evs.voto.index') }}" class="brand-link">
      <img src="{{ asset('modules/evs/images/voto.png') }}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EVS {{ __('Electronic voting') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="row col-md-12">
        <div class="image mt-2 mb-2">
          @if(isset(Auth::user()->person->avatar))
          <img src="{{ asset('storage/'.Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        @guest
          <div class="col info info-user">
            <div>{{ trans('menu.Welcome') }}</div>
            <div><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('Auth.Login') }}</a></div>

          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a>
          </div>
        @else
          <div class="col info info-user">
            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
            <div class="small"><em> {{ Auth::user()->roles->count() > 0 ? Auth::user()->roles[0]->name : 'Sin rol asignado' }} </em></div>
          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
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
                  <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
                    <i class="fas fa-puzzle-piece"></i>
                    <p>
                      {{ trans('sica::menu.Back to') }} {{ env('APP_NAME') }}
                    </p>
                  </a>
                </li>
            </ul>
        </nav>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      @if(Route::is('*.juries.*'))

          <li class="nav-item">
            <a href="{{ route('cefa.evs.juries.login') }}" class="nav-link {{ ! Route::is('cefa.evs.juries.login') ?: 'active' }}">
              <i class="fas fa-home"></i>
              <p>
                {{ __('Ingresar') }}
              </p>
            </a>
          </li>
        @if(session()->has('jury_id'))
          <li class="nav-item">
            <a href="{{ route('cefa.evs.juries.access') }}" class="nav-link {{ ! Route::is('cefa.evs.juries.access') ?: 'active' }}">
              <i class="fas fa-id-card"></i>
              <p>
                {{ __('Autorized') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.juries.report') }}" class="nav-link {{ ! Route::is('cefa.evs.juries.report') ?: 'active' }}">
              <i class="fas fa-file-alt"></i>
              <p>
                {{ __('Report') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.juries.logout') }}" class="nav-link {{ ! Route::is('cefa.evs.juries.logout') ?: 'active' }}">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                {{ __('Logout') }}
              </p>
            </a>
          </li>
        @endif
      @endif
      @if(Route::is('*.voto.*'))
          <li class="nav-item">
            <a href="{{ route('cefa.evs.voto.index') }}" class="nav-link {{ ! Route::is('cefa.evs.voto.index') ?: 'active' }}">
              <i class="fas fa-home"></i>
              <p>
                {{ __('Home') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.voto.votar') }}" class="nav-link {{ ! Route::is('cefa.evs.voto.votar*') ?: 'active' }}">
              <i class="fas fa-vote-yea"></i>
              <p>
                Votar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.voto.normatividad') }}" class="nav-link {{ ! Route::is('cefa.evs.voto.normatividad') ?: 'active' }}">
              <i class="far fa-file-alt"></i>
              <p>
                {{ __('Normativity') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.voto.resultados') }}" class="nav-link {{ ! Route::is('cefa.evs.voto.resultados') ?: 'active' }}">
              <i class="fas fa-chart-bar"></i>
              <p>
                {{ __('Voting results') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefa.evs.voto.desarrolladores') }}" class="nav-link {{ ! Route::is('cefa.evs.voto.desarrolladores') ?: 'active' }}">
              <i class="fas fa-users"></i>
              <p>
                {{ __('Developers') }}
              </p>
            </a>
          </li>
      @endif
        @guest
        @else
        @if(Route::is('*.admin.*'))

          <li class="nav-item">
            <a href="{{ route('evs.admin.dashboard') }}" class="nav-link {{ ! Route::is('evs.admin.dashboard') ?: 'active' }}">
              <i class="fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.elections') }}" class="nav-link {{ ! Route::is('evs.admin.elections*') ?: 'active' }}">
              <i class="fas fa-calendar-alt"></i>
              <p>
                {{ __('Elections') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.candidates') }}" class="nav-link {{ ! Route::is('evs.admin.candidates*') ?: 'active' }}">
              <i class="fas fa-id-card-alt"></i>
              <p>
                {{ __('Candidates') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.juries') }}" class="nav-link {{ ! Route::is('evs.admin.juries*') ?: 'active' }}">
              <i class="fas fa-gavel"></i>
              <p>
                {{ __('Juries') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('evs.admin.electeds') }}" class="nav-link {{ ! Route::is('evs.admin.electeds*') ?: 'active' }}">
              <i class="fas fa-id-card"></i>
              <p>
                {{ __('Elected') }}
              </p>
            </a>
          </li>
<button id="btnExcel">
  <i class="fas fa-file-excel"></i>
  <span>Descargar <br> lista de autorizados</span>
</button>

<style>
#btnExcel {
    background: linear-gradient(90deg, #1D6F42, #28A745);
    color: white;
    font-size: 16px;
    font-weight: 500;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

#btnExcel i {
    font-size: 48px; /* tamaño grande del icono */
    min-width: 48px; /* asegura que no se achique */
    text-align: center;
}

#btnExcel span {
    display: inline-block;
    line-height: 1.2;
}

#btnExcel:hover {
    background: linear-gradient(90deg, #166038, #218838);
    transform: translateY(-2px);
    box-shadow: 0 5px 8px rgba(0,0,0,0.15);
}

#btnExcel:active {
    transform: translateY(0);
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
</style>

<!-- SheetJS desde CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.getElementById("btnExcel").addEventListener("click", function() {
    fetch("{{ route('cefa.evs.exel_autorizaciones') }}")
        .then(res => res.json())
        .then(data => {
            let ws = XLSX.utils.json_to_sheet(data);
            let wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Autorizaciones");
            XLSX.writeFile(wb, "autorizaciones.xlsx");
        })
        .catch(err => console.error(err));
});
</script>
        @endif
        @endguest


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
