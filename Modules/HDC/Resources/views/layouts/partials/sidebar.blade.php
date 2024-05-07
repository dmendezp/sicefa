  <div class="sidebar-color">
      <aside class="main-sidebar sidebar-dark-blue elevation-4">
          <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
          <a href="{{ route('cefa.hdc.index') }}" class="brand-link text-decoration-none">
              <img src="{{ asset('modules/HDC/img/logo.png') }}" class="brand-image" alt="HDC-Logo">{{-- Icono de huella de carbono --}}
              <span class="brand-text font-weight-bold">{{ trans('hdc::hdcgeneral.carbonfootprint') }}</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <div class="user-panel mt-3 pb-3 mb-1 d-flex">
                  <div class="image">
                      @if (isset(Auth::user()->person->avatar))
                          <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"class="img-circle elevation-2"
                              alt="User Image">
                      @else
                          <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                              alt="User Image">
                      @endif
                  </div>
                  @guest
                      <div class="col info info-user">
                          <div>{{ trans('menu.Welcome') }}</div>
                          <div>
                              <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('hdc::hdcgeneral.login') }}</a>
                          </div>
                      </div>
                      <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right"
                          title="{{ trans('Auth.Login') }}">
                          <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">
                              <i class="fas fa-sign-in-alt"></i>
                          </a>
                      </div>
                  @else
                      <div class="col info info-user">
                          <div data-toggle="tooltip" data-placement="top"
                              title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                              {{ Auth::user()->nickname }}
                          </div>
                          <div class="small">
                              <em> {{ Auth::user()->roles[0]->name }}</em>
                          </div>
                      </div>
                      <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right"
                          title="{{ trans('Auth.Logout') }}">
                          <a href="{{ route('logout') }}" class="d-block"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                              <p>{{ trans('hdc::hdcgeneral.BacktoSICEFA') }}</p>
                          </a>
                      </li>
                  </ul>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">

                      <!-- Menú de opciones para administrador -->
                      @if (Route::is('hdc.admin.*'))
                      @if (Auth::user()->havePermission('hdc.admin.resultfromaspects'))
                                <li class="nav-item">
                                    <a href="{{ route('hdc.admin.parameter') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-wrench"></i>
                                        <p>
                                            {{ trans('hdc::hdcgeneral.Parameters') }}
                                        </p>
                                    </a>
                                </li>
                              <li class="nav-item">
                                  <a href="{{ route('hdc.admin.resultfromaspects') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-folder-open"></i>
                                      <p>
                                          {{ trans('hdc::hdcgeneral.assign_environmental_aspects') }}
                                      </p>
                                  </a>
                              </li>
                          @endif
                          @if (Auth::user()->havePermission('hdc.admin.table'))
                              <li class="nav-item">
                                  <a href="{{ Route('hdc.admin.table') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-pen-to-square"></i>
                                      <p>
                                          {{ trans('hdc::hdcgeneral.RegisterConsumption') }}
                                      </p>
                                  </a>
                              </li>
                          @endif
                          <li class="nav-item">
                              <a href="{{ route('hdc.admin.generate.report') }}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-file-arrow-down"></i>
                                  <p>
                                      {{ trans('hdc::report.Report_Indicator') }}
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('hdc.admin.Graficas') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-column"></i>
                                <p>
                                    {{ trans('hdc::hdcgeneral.Graphics') }}
                                </p>
                            </a>
                        </li>



                      @endif

                      <!-- Menú de opciones para Encargado -->
                      @if (Route::is('hdc.charge.*'))
                        <li class="nav-item">
                            <a href="{{ route('hdc.charge.parameter') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-wrench"></i>
                                <p>
                                    {{ trans('hdc::hdcgeneral.Parameters') }}
                                </p>
                            </a>
                        </li>
                          @if (Auth::user()->havePermission('hdc.charge.table'))
                              <li class="nav-item">
                                  <a href="{{ Route('hdc.charge.table') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-pen-to-square"></i>
                                      <p>
                                          {{ trans('hdc::hdcgeneral.RegisterConsumption') }}
                                      </p>
                                  </a>
                              </li>
                          @endif

                          <li class="nav-item">
                              <a href="{{ route('hdc.charge.generate.report') }}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-file-arrow-down"></i>
                                  <p>
                                      {{ trans('hdc::report.Report_Indicator') }}
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('hdc.charge.Graficas') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-column"></i>
                                <p>
                                    {{ trans('hdc::hdcgeneral.Graphics') }}
                                </p>
                            </a>
                        </li>

                      @endif

                      <!-- Menú de opciones públicas -->


                      {{-- Menú de opciones públicas --}}
                      @if (Route::is('cefa.hdc.*'))
                          <li class="nav-item">
                              <a href="{{ route('cefa.hdc.Graficas') }}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-chart-column"></i>
                                  <p>
                                      {{ trans('hdc::hdcgeneral.Graphics') }}
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('cefa.hdc.developers') }}" class="nav-link">
                                  <i class="fa-solid fa-people-group"></i>
                                  <p>
                                      {{ trans('hdc::developers.developers') }}
                                  </p>
                              </a>
                          </li>
                      @endif
                    @guest
                        @else
                        <hr class="sidebar-divider" style="border-color: white;">
                        <li class="nav-item">
                            <a href="{{ route('cefa.hdc.carbonfootprint.persona') }}" class="nav-link">
                                <i class="nav-icon fas fa-shoe-prints"></i>
                                <p>
                                    {{ trans('hdc::hdcgeneral.calculatefootprint') }}
                                </p>
                            </a>
                        </li>
                    @endguest
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
  </div>
