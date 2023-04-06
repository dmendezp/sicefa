  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
      <img src="{{ asset('cefamaps/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CEFAMAPS</span>
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
          <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        @guest
          <div class="col info info-user">
            <div>{{ trans('menu.Welcome') }}</div>             
            <div><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
          </div>
          <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a>
          </div>  
        @else
          <div class="col info info-user">
            <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
            <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
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
        @if(!Route::is('*.sst.*'))
          <li class="nav-item">
            <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('cefa.cefamaps.index') ?: 'active' }}">
              <i class="nav-icon fas fa-solid fa-map"></i>
              <p>
              {{ trans('cefamaps::menu.Overview map') }}
              </p>
            </a>
          </li>
          <!-- Inicio para las configuraciones del adminitrador -->
          @if (Route::is('*admin.*'))
            <li class="nav-item {{ ! Route::is('cefamaps.admin.config.*') ?: 'menu-is-opening menu-open' }}">
              <a href="#" class="nav-link {{ ! Route::is('cefamaps.admin.config.*') ?: 'active' }}">
                <i class="nav-icon fa-solid fa-gears"></i>
                <p>
                  {{ trans('cefamaps::environment.Setting') }}
                  <i class="right fa-solid fa-gear"></i>
                </p>
              </a>
              <!-- Inicio para las Unidades del adminitrador -->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefamaps.admin.config.unit.index') }}" class="nav-link {{ ! Route::is('cefamaps.admin.config.unit.*') ?: 'active' }}">
                    <i class="nav-icon fa-solid fa-mountain-sun"></i>
                    <p>{{ trans('cefamaps::unit.Units') }}</p>
                  </a>
                </li>
              </ul>

              
              <!-- Fin para las Unidades del adminitrador -->
              <!-- Inicio para las granjas del adminitrador -->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefamaps.admin.config.farm.index') }}" class="nav-link {{ ! Route::is('cefamaps.admin.config.farm.*') ?: 'active' }}">
                    <i class="nav-icon fa-solid fa-tractor"></i>
                    <p>{{ trans('cefamaps::farm.Farm') }}</p>
                  </a>
                </li>
              </ul>
              <!-- Fin para las granjas del adminitrador -->
              <!-- Inicio para los Ambientes del adminitrador -->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefamaps.admin.config.environment.index') }}" class="nav-link {{ ! Route::is('cefamaps.admin.config.environment.*') ?: 'active' }}">
                    <i class="nav-icon fas fa-solid fa-chalkboard-user"></i>
                    <p>{{ trans('cefamaps::environment.Environment') }}</p>
                  </a>
                </li>
              </ul>
              <!-- Fin para los Ambientes del adminitrador -->
              <!-- Inicio para las paginas del administrador -->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cefamaps.admin.config.page.index') }}" class="nav-link {{ ! Route::is('cefamaps.admin.config.page.*') ?: 'active' }}">
                    <i class="nav-icon fas fa-regular fa-file-lines"></i>
                    <p>{{ trans('cefamaps::page.Page') }}</p>
                  </a>
                </li>
              </ul>
              <!-- Fin para las paginas del administrador -->
            </li>
          @endif
          <!-- Fin para las configuraciones del adminitrador -->
          <!-- MENU PARA UNITS -->
      <li class="nav-item {{ ! Route::is('cefa.cefamaps.unit.view*') ?: 'menu-is-opening menu-open' }}">
          <a href="#" class="nav-link {{ ! Route::is('cefa.cefamaps.unit.view.*') ?: 'active' }}">
            <i class="nav-icon fa-solid fa-mountain-sun"></i>
              <p>
                {{ trans('Areas') }}
                <i class="right fa-solid fa-map-pin"></i>
             </p>
           </a>
        <ul class="nav nav-treeview">
              
            <!-- area agricola -->  
         <li class="nav-item {{ ! Route::is('cefa.cefamaps.unit.view*') ?: 'menu-is-opening menu-open' }}">
            <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('cefa.cefamaps.unit.view.*') ?: 'active' }}">
                <i class="fas fa-seedling"></i>
                  <p>
                     {{ trans('Agricola') }}
                  </p>
              </a>
           <ul class="nav nav-treeview">
              <center><h6>UNIDADES</h6></center>
                 <li class="nav nav-item">
                   @foreach($unit as $u)
                      <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('/cefamaps/unit/view/*'.$u->id) ?: 'active' }}">
                       <i class="nav-icon {{$u->icon}}"></i>
                         <p>{{$u->name}}</p>
                      </a>
                    @endforeach
                 </li>
             </ul>
          </li>
            
        
          <!-- area pecuaria --> 
         <li class="nav-item {{ ! Route::is('cefa.cefamaps.unit.view*') ?: 'menu-is-opening menu-open' }}">
            <a href="{{ route('cefa.cefamaps.index') }}"  class="nav-link {{ ! Route::is('cefa.cefamaps.unit.view.*') ?: 'active' }}">
               <i class="fa-solid fa-fish"></i>
                  <p>
                    {{ trans('Pecuaria') }}
                 </p>
             </a>
           <ul class="nav nav-treeview">
              <center><h6>UNIDADES</h6></center>
                 <li class="nav nav-item">
                    @foreach($unit as $u)
                      <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('/cefamaps/unit/view/*'.$u->id) ?: 'active' }}">
                        <i class="nav-icon {{$u->icon}}"></i>
                          <p>{{$u->name}}</p>
                      </a>
                    @endforeach
                 </li>
             </ul>
         </li>  


         <!-- area ambiental --> 
         <li class="nav-item {{ ! Route::is('cefa.cefamaps.unit.view*') ?: 'menu-is-opening menu-open' }}">
            <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('cefa.cefamaps.unit.view.*') ?: 'active' }}">
                <i class="fas fa-chalkboard-teacher"></i>
                   <p>
                      {{ trans('Ambiental') }}
                  </p>
              </a>
           <ul class="nav nav-treeview">
             <center><h6>UNIDADES</h6></center>
                 <li class="nav nav-item">
                   @foreach($unit as $u)
                     <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('/cefamaps/unit/view/*'.$u->id) ?: 'active' }}">
                       <i class="nav-icon {{$u->icon}}"></i>
                         <p>{{$u->name}}</p>
                      </a>
                   @endforeach
                 </li>
             </ul>
         </li>

           <!-- area infraestructura --> 
         <li class="nav-item {{ ! Route::is('cefa.cefamaps.unit.view*') ?: 'menu-is-opening menu-open' }}">
            <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('cefa.cefamaps.unit.view.*') ?: 'active' }}">
               <i class="fas fa-house-user"></i>
                   <p>
                       {{ trans('Infraestructura') }}
                   </p>
               </a>
            <ul class="nav nav-treeview">
              <center><h6>UNIDADES</h6></center>
                   <li class="nav nav-item">
                     @foreach($unit as $u)
                       <a href="{{ route('cefa.cefamaps.index') }}" class="nav-link {{ ! Route::is('/cefamaps/unit/view/*'.$u->id) ?: 'active' }}">
                         <i class="nav-icon {{$u->icon}}"></i>
                            <p>{{$u->name}}</p>
                       </a>
                     @endforeach
                   </li>
              </ul>
         </li>

         
        </ul>
     </li>

          <!-- CIERRA MENU PARA UNITS -->
          <!-- MENU PARA FARMS -->
          <li class="nav-item {{ ! Route::is('cefa.cefamaps.farm.view*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link {{ ! Route::is('cefa.cefamaps.farm.view.*') ?: 'active' }}">
              <i class="nav-icon fa-solid fa-tractor"></i>
              <p>
                {{ trans('cefamaps::farm.Farm') }}
                <i class="right fa-solid fa-map-pin"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav nav-item">
                @foreach($farm as $f)
                  <a href="{{ url('/cefamaps/farm/view/'.$f->id) }}" class="nav-link {{ ! Route::is('cefa.cefamaps.farm.view.*') ?: 'active' }}">
                    <i class="nav-icon <!-- falta el icono para Farm -->"></i>
                    <p>{{$f->name}}</p>
                  </a>
                @endforeach
              </li>
            </ul>
          </li>
          <!-- CIERRA MENU PARA FARMS -->
          <!-- MENU PARA ENVIRONMENT -->
          <li class="nav-item {{ ! Route::is('cefamaps.admin.environment.views*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link {{ ! Route::is('cefamaps.admin.environment.views.*') ?: 'active' }}">
              <i class="nav-icon fa-solid fa-city"></i>
              <p>
                {{ trans('cefamaps::environment.Environment') }}
                <i class="right fa-solid fa-map-pin"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @foreach($classenviron as $c)
              <li class="nav nav-item">
                <a href="{{ url('/cefamaps/environment/view/'.$c->id) }}" class="nav-link {{ ! Route::is('cefa.cefamaps.environment.view') ?: 'active' }}">
                  <i class="nav-icon fa-solid fa-school-flag"></i>
                  <p>{{$c->name}}</p>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <!-- CIERRA MENU PARA ENVIRONMENT -->
        @else
          <li class="nav-item">
            <a href="{{ route('cefamaps.sst.evacuation') }}" class="nav-link {{ ! Route::is('cefamaps.sst.evacuation*') ?: 'active' }}">
            <i class="fas fa-door-open"></i>
              <p>
                Rutas de evacuacion
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefamaps.sst.Extintores') }}" class="nav-link {{ ! Route::is('cefamaps.sst.Extintores*') ?: 'active' }}">
            <i class="fas fa-fire-extinguisher"></i>
              <p>
                Extintores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cefamaps.sst.healt') }}" class="nav-link">
            <i class="fas fa-heartbeat"></i>
              <p>
                Salud
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