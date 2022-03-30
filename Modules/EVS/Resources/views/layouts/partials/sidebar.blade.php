  <aside class="main-sidebar sidebar-light-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.evs.voto.index') }}" class="brand-link">
      <img src="{{ asset('evs/images/voto.png') }}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EVS {{ __('Electronic voting') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @guest
        <div class="image">
          <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>

        <div class="info col-md-9">
          <a href="{{ route('login') }}" class="d-block">{{ __('Welcome') }} <div class="float-right"><span><i class="fas fa-sign-in-alt " ></i></span></div></a>
        </div>
      @else
        <div class="image">
          <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>

        <div class="info col-md-9">
          <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ Auth::user()->nickname }} <div class="float-right"><span><i class="fas fa-sign-out-alt"></i></span></div></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
          </form>
        </div>


      @endguest
      </div>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('general/images/logosicefa.png') }}" class="" alt="">
        </div>
        <div class="info">
          <a href="{{ route('cefa.welcome') }}" class="d-block">{{ __('Back to SICEFA') }}</a>
        </div>
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

        @endif
        @endguest


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>