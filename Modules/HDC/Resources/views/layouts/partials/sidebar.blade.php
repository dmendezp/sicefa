  <div class="sidebar-color">
      <aside class="main-sidebar sidebar-dark-blue elevation-4">
          <!-- Bran Logo: Aqui se realiza el ajuste del logo y titulo que esta en el sidebar-->
          <a href="{{ route('cefa.hdc.index') }}" class="brand-link text-decoration-none">
              <img src="{{ asset('modules/HDC/img/logo.png')}}" class="brand-image" alt="HDC-Logo">{{-- Icono de huella de carbono --}}
              <span class="brand-text font-weight-bold">Huella de Carbono</span>
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
                              <a href="{{ route('login') }}" class="d-block">Iniciar sesión</a>
                          </div>
                      </div>
                      <div class="col-auto info float-right mt-2" data-toggle="tooltip" data-placement="right"
                          title="{{ trans('Auth.Login') }}">
                          <a href="{{ route('login') }}" class="d-block">
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
                              <p>Volver a SICEFA</p>
                          </a>
                      </li>
                  </ul>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">
                      <li class="nav-item">
                          <a href="#" class="nav-link active ">
                              <i class="nav-icon fa-solid fa-fish-fins"></i>
                              <p>
                                  Pecuaria
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ Route('cefa.hdc.bovinos') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-cow"></i>
                                      <p>Bovinos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ Route('cefa.hdc.ovinos') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-cow"></i>
                                      <p>Ovinos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ Route('cefa.hdc.porcinos') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-hippo"></i>
                                      <p>Porcinos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ Route('cefa.hdc.equinos') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-horse-head"></i>
                                      <p>Equinos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ Route('cefa.hdc.piscicola') }}" class="nav-link">
                                      <i class="nav-icon fa-solid fa-fish fa-spin"></i>
                                      <p>Piscicola</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa fa-leaf"></i>
                              <p>
                                  Ambiental
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="./index.html" class="nav-link ">
                                      <i class="nav-icon fa-solid fa-dumpster"></i>
                                      <p>Residuos Sólidos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index2.html" class="nav-link">
                                      <i class="nav-icon fa-solid fa-recycle"></i>
                                      <p>Residuos Orgánicos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-solid fa-tree"></i>
                                      <p>Vivero ornamental y forestal</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-solid fa-mountain-sun"></i>
                                      <p>Zonas Verdes</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-solid fa-worm"></i>
                                      <p>Lombricultivo</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-solid fa-fingerprint"></i>
                                      <p>Huella de Carbono</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa fa-seedling"></i>
                              <p>
                                  Agricola
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="./index.html" class="nav-link">
                                      <i class="nav-icon far fa-circle nav-icon"></i>
                                      <p>Guayaba</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index2.html" class="nav-link">
                                      <i class="nav-icon fa-brands fa-pagelines"></i>
                                      <p>Aguacate</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-brands fa-pagelines"></i>
                                      <p>Guanabana</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-brands fa-pagelines"></i>
                                      <p>Mango</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="nav-icon fa-brands fa-pagelines"></i>
                                      <p>Cacao</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Cítricos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Vívero Cacao</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Piña</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Vívero Cítricos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Pasiflora</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Invernadero</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Huerta</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa fa-cheese"></i>
                              <p>
                                  Agroindustriales
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="./index.html" class="nav-link active">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Procesamiento de lacteos</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index2.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Procesamiento de FRUHOR</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Procesamiento de chocolateria y confiteria</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Procesamiento de Cárnicos</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa fa-handshake"></i>
                              <p>
                                  Servicio
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="./index.html" class="nav-link active">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Estación de Café</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index2.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Punto de venta</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Pico-Hidraulica</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Estación Metereológica</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Centro de Convivencia</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Restaurante</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="./index3.html" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Unidad mecanización</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
  </div>
