<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link" style="text-decoration: none; display: flex; align-items: center;">
        <i class="fas fa-hand-holding-heart" style="color: #ffffff; font-size: 60px; margin-right: 10px;"></i>
        <div>
          <span class="brand-text font-weight-dark" id="logo">Bienestar al</span><br>
          <span class="brand-text font-weight-dark" id="logo">Aprendiz</span>
        </div>
      </a><br>
    
      <!-- Sidebar -->
      <div class="sidebar" >
        
       <!-- Línea separadora -->
       <hr class="sidebar-divider">
       <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="row col-md-12">
                <div class="image mt-2 mb-2">
                    @if (isset(Auth::user()->person->avatar))
                        <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}"
                            class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                </div>
                @guest
                    <div class="col info info-user">
                        <div>{{ trans('menu.Welcome') }}</div>
                        <div><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>

                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right"
                        title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block"><i
                                class="fas fa-sign-in-alt"></i></a>
                    </div>
                @else
                    <div class="col info info-user">
                        <div data-toggle="tooltip" data-placement="top"
                            title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
                            {{ Auth::user()->nickname }}
                        </div>
                        <div class="small">
                            <em> {{ Auth::user()->roles->count() > 0 ? Auth::user()->roles[0]->name : 'Sin rol asignado' }} </em>
                        </div>
                    </div>
                    <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
                        <a href="{{ route('logout') }}" class="d-block"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i
                                class="fas fa-sign-out-alt"></i></a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
        
      <!-- Enlace "Volver a Sicefa" -->
      <div class="user-panel ">
            <nav class="">
              <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                  <a href="{{ route('cefa.welcome') }}" class="nav-link">
                    <i class="fas fa-puzzle-piece"></i>
                    <p>
                    {{ trans('bienestar::menu.Back to Sicefa')}}
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
           <!-- Línea separadora -->
           <hr class="sidebar-divider">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-user"></i>
                <p>{{ trans('bienestar::menu.Apprentices')}}</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-pizza-slice"></i>
                <p>{{ trans('bienestar::menu.Feeding')}} <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefa.bienestar.AssistancesFoods') }}" class="nav-link">Listados apoyo alimentacion </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link"><p>Opción 2</p></a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link"><p>Opción 3</p></a>
                </li>
              </ul>
            </li>    
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-bus"></i>
                <p>{{ trans('bienestar::menu.Transportation')}} <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefa.bienestar.buses') }}" class="nav-link">Buses</a>
                </li>
              
                @if(Auth::user()->havePermission('bienestar.admin.crud.transportroutes'))
                <li class="nav-item">
                  <a href="{{ route('bienestar.admin.crud.transportroutes') }}" class="nav-link">Rutas</a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="#" class="nav-link">Asignar Rutas</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="fas fa-handshake"></i>
                <p>{{ trans('bienestar::menu.Benefits')}} <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.admin.crud.benefits'))
              <li class="nav-item">
                  <a href="{{ route('bienestar.admin.crud.benefits') }}" class="nav-link">Tipos de Beneficios</a>
                </li>
                @endif
                @if(Auth::user()->havePermission('bienestar.admin.crud.typeofbenefits'))
                <li class="nav-item">
                  <a href="{{ route('bienestar.admin.crud.typeofbenefits')}}" class="nav-link">Tipo de Beneficiario</a>
                </li>
                @endif
                @if(Auth::user()->havePermission('bienestar.admin.view.benefitstypeofbenefits'))
                <li class="nav-item">
                  <a href="{{ route('bienestar.admin.view.benefitstypeofbenefits')}}" class="nav-link">Configurar Beneficios</a>
                </li>
                @endif
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list"></i>
                <p>{{ trans('bienestar::menu.Convoctions')}} <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('cefa.bienestar.Convocations')}}" class="nav-link">Convocatorias</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('cefa.bienestar.editform') }}" class="nav-link">Formularios</a>
                </li>                
                <li class="nav-item">
                  <a href="" class="nav-link">Configurar Convocatoria</a>
                </li>
                @if(Route::is('cefa.bienestar.*'))
                <li class="nav-item">
                  <a href="{{ route('cefa.bienestar.postulations')}}" class="nav-link">Postulaciones </a>
                </li>
                @endif
                @if(Auth::user()->havePermission('bienestar.admin.view.postulation-management'))
                <li class="nav-item">
                  <a href="{{ route('bienestar.admin.view.postulation-management')}}" class="nav-link">Gestionar Postulaciones</a>
                </li>
                @endif
              </ul>
            </li>
              <!-- Nueva sección "Consulta" debajo de "Convocatorias" -->
        <li class="nav-item has-treeview">
          <a href="{{route('cefa.bienestar.callconsultation')}}" class="nav-link">
            <i class="fas fa-search"></i>
            <p>Consulta</p>
          </a>
        </li>
        <!-- Fin de la nueva sección "Consulta" -->
          </ul><br>      
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>