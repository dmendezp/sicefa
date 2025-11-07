  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index" class="brand-link">
          <img src="{{ asset('modules/cefamaps/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">CEFAMAPS</span>
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
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block custom-color" style="text-decoration: none">{{ trans('cefamaps::general.Session') }}</a>
                </div>
                <div class="col-auto info float-right ">
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Iniciar Sesion">
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
                    <a href="{{ route('logout') }}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Cerrar Sesion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

        <div class="user-panel d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('cefa.welcome') }}"
                        class="nav-link {{ !Route::is('cefa.contact.maps') ?: 'active' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ trans('cefamaps::general.Back to SICEFA') }}</p>
                    </a>
                </li>
            </ul>
        </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  @if (!Route::is('*.sst.*'))
                      <li class="nav-item">
                          <a href="{{ route('cefa.cefamaps.index') }}"
                              class="nav-link {{ !Route::is('cefa.cefamaps.index') ?: 'active' }}">
                              <i class="nav-icon fas fa-solid fa-map"></i>
                              <p>
                                  {{ trans('cefamaps::general.Overview_Map') }}
                              </p>
                          </a>
                      </li>
                      <!-- Inicio para las configuraciones del administrador -->
                      @if (Route::is('*admin.*'))
                          <li
                              class="nav-item {{ !Route::is('cefamaps.admin.config.*') ?: 'menu-is-opening menu-open' }}">
                              <a href="#"
                                  class="nav-link {{ !Route::is('cefamaps.admin.config.*') ?: 'active' }}">
                                  <i class="nav-icon fa-solid fa-gears"></i>
                                  <p>
                                      {{ trans('cefamaps::general.Settings') }}
                                      <i class="right fa-solid fa-gear"></i>
                                  </p>
                              </a>
                              <!-- Inicio para el sector del adminitrador -->
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('cefamaps.admin.config.sector.index') }}"
                                          class="nav-link {{ !Route::is('cefamaps.admin.config.sector.*') ?: 'active' }}">
                                          <i class="nav-icon fa-solid fa-vector-square"></i>
                                          <p>{{ trans('cefamaps::general.Sectors') }}</p>
                                      </a>
                                  </li>
                              </ul>
                              <!-- Fin para el sector del adminitrador -->
                              <!-- Inicio para las Unidades del adminitrador -->
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('cefamaps.admin.config.unit.index') }}"
                                          class="nav-link {{ !Route::is('cefamaps.admin.config.unit.*') ?: 'active' }}">
                                          <i class="nav-icon fa-solid fa-mountain-sun"></i>
                                          <p>{{ trans('cefamaps::general.Units') }}</p>
                                      </a>
                                  </li>
                              </ul>
                              <!-- Fin para las Unidades del adminitrador -->
                              <!-- Inicio para las Clases de ambientes del adminitrador -->
                              <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('cefamaps.admin.config.class.index') }}"
                                        class="nav-link {{ !Route::is('cefamaps.admin.config.class.*') ?: 'active' }}">
                                        <i class="nav-icon fa-solid fa-building-wheat"></i>
                                        <p>{{ trans('cefamaps::general.Class') }}</p>
                                    </a>
                                </li>
                            </ul>
                            <!-- Fin para las Clases de ambientes del adminitrador -->
                              <!-- Inicio para los Ambientes del adminitrador -->
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('cefamaps.admin.config.environment.index') }}"
                                          class="nav-link {{ !Route::is('cefamaps.admin.config.environment.*') ?: 'active' }}">
                                          <i class="nav-icon fas fa-solid fa-chalkboard-user"></i>
                                          <p>{{ trans('cefamaps::general.Environments') }}</p>
                                      </a>
                                  </li>
                              </ul>
                              <!-- Fin para los Ambientes del adminitrador -->
                              <!-- Inicio para las paginas del administrador -->
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('cefamaps.admin.config.page.index') }}"
                                          class="nav-link {{ !Route::is('cefamaps.admin.config.page.*') ?: 'active' }}">
                                          <i class="nav-icon fas fa-regular fa-file-lines"></i>
                                          <p>{{ trans('cefamaps::general.Pages') }}</p>
                                      </a>
                                  </li>
                              </ul>
                              <!-- Fin para las paginas del administrador -->
                          </li>
                      @endif
                      @if (Route::is('*environmentmanager.*'))
                          <li
                              class="nav-item {{ !Route::is('cefamaps.environmentmanager.config.*') ?: 'menu-is-opening menu-open' }}">
                              <a href="#"
                                  class="nav-link {{ !Route::is('cefamaps.environmentmanager.config.*') ?: 'active' }}">
                                  <i class="nav-icon fa-solid fa-gears"></i>
                                  <p>
                                      {{ trans('cefamaps::general.Settings') }}
                                      <i class="right fa-solid fa-gear"></i>
                                  </p>
                              </a>
                              <!-- Inicio para las Clases de ambientes del adminitrador -->
                              <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('cefamaps.environmentmanager.config.class.index') }}"
                                        class="nav-link {{ !Route::is('cefamaps.admin.config.class.*') ?: 'active' }}">
                                        <i class="nav-icon fa-solid fa-building-wheat"></i>
                                        <p>{{ trans('cefamaps::general.Class') }}</p>
                                    </a>
                                </li>
                            </ul>
                            <!-- Fin para las Clases de ambientes del adminitrador -->
                            <!-- Inicio para los Ambientes del adminitrador -->
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('cefamaps.environmentmanager.config.environment.index') }}"
                                        class="nav-link {{ !Route::is('cefamaps.admin.config.environment.*') ?: 'active' }}">
                                        <i class="nav-icon fas fa-solid fa-chalkboard-user"></i>
                                        <p>{{ trans('cefamaps::general.Environments') }}</p>
                                    </a>
                                </li>
                            </ul>
                            <!-- Fin para los Ambientes del adminitrador -->
                          </li>
                      @endif
                      <!-- Fin para las configuraciones del adminitrador -->
                      <!-- Inicio de los sectores y unidades -->
                      @if (!Route::is('*environmentmanager.*'))
                        @foreach ($sector as $s)
                            <li class="nav-item {{ !(Request::url() == url('/cefamaps/unit/view/' . $s->id)) ?: 'menu-is-opening menu-open' }}">
                                <a href="#" class="nav-link {{ !(Request::url() == url('/cefamaps/sector/view/' . $s->id)) ?: 'active' }}">
                                    <i class="nav-icon fa-solid fa-mountain-city"></i>
                                    <p>
                                        {{ $s->name }}
                                        <i class="right fa-solid fa-map-pin"></i>
                                    </p>
                                </a>
                                @foreach ($s->productive_units as $u)
                                    <ul class="nav nav-treeview">
                                        <li class="nav nav-item">
                                            <a href="{{ route('cefa.cefamaps.environment.viewenvironments', ['id' => $u->id]) }}
                                                " class="nav-link unit-link" data-unit-id="{{ $u->id }}">
                                                <i class="nav-icon {{ $u->icon }}"></i>
                                                <p>{{ $u->name }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach

                            </li>
                        @endforeach
                        <!-- Fin de los sectores y unidades -->
                        <!-- MENU PARA ENVIRONMENT -->
                        <li
                            class="nav-item {{ !Route::is('cefa.cefamaps.environment.view') ?: 'menu-is-opening menu-open' }}">
                            <a href="#" class="nav-link {{ !Route::is('cefa.cefamaps.environment.view') ?: 'active' }}">
                                <i class="nav-icon fa-solid fa-city"></i>
                                <p>
                                    {{ trans('cefamaps::general.Environments') }}
                                    <i class="right fa-solid fa-map-pin"></i>
                                </p>
                            </a>
                            @foreach ($classenviron as $c)
                                <ul class="nav nav-treeview">
                                    <li class="nav nav-item">
                                        <a href="{{ url('/cefamaps/environment/view/' . $c->id) }}"
                                            class="nav-link {{ !(Request::url() == url('/cefamaps/environment/view/' . $c->id)) ?: 'active' }}">
                                            <i class="nav-icon fa-solid fa-school"></i>
                                            <p>{{ $c->name }}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                        <!-- CIERRA MENU PARA ENVIRONMENT -->
                        @endif
                  @else
                      <li class="nav-item">
                          <a href="{{ route('cefamaps.sst.evacuation') }}" class="nav-link {{ !Route::is('cefamaps.sst.evacuation*') ?: 'active' }}">
                              <i class="nav-icon fas fa-door-open"></i>
                              <p>
                                  {{ trans('cefamaps::general.Evacuation_Routes') }}
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('cefamaps.sst.Extintores') }}" class="nav-link {{ !Route::is('cefamaps.sst.Extintores*') ?: 'active' }}">
                              <i class="nav-icon fas fa-fire-extinguisher"></i>
                              <p>
                                {{ trans('cefamaps::general.Fire_Extinguishers') }}
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('cefamaps.sst.healt') }}" class="nav-link">
                              <i class="nav-icon fas fa-heartbeat"></i>
                              <p>
                                {{ trans('cefamaps::general.Health') }}
                              </p>
                          </a>
                      </li>
                  @endif
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
  