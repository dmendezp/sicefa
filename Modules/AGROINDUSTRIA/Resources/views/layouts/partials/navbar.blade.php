<nav class="navbar navbar-expand-lg navbar-Dark" style="background-color:rgb(247, 244, 244); margin-bottom:20px">
    <a class="navbar-brand" id="title" href="{{ route('cefa.agroindustria.home.index') }}">
        @if (session('viewing_unit'))
            AGROINDUSTRIA - {{ session('viewing_unit_name') }}
        @else
            AGROINDUSTRIA
        @endif
    </a>
    

    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>

    <div class="collapse navbar-collapse d-sm-flex" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <!-- Acceso general -->
            @if(Route::is('*home.*'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.home.index')}}">{{trans('agroindustria::menu.Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.home.formulations.recipes')}}">{{trans('agroindustria::menu.Products')}}</a>
                </li>
            @endif
            
            @if(auth()->check() && checkRol('agroindustria.admin'))  
                <li class="nav-item">
                    <a href="{{route('cefa.agroindustria.admin.discharge')}}" class="nav-link">{{trans('agroindustria::menu.Desregistrations')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.production')}}">Producción</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.movements')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.activity')}}">{{trans('agroindustria::menu.Activities')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.formulations')}}">{{trans('agroindustria::formulations.Recipes')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.storer.inventory')}}">{{trans('agroindustria::menu.Inventory')}}</a>
                </li>
            @endif

            @if(Route::is('*units.*'))
                <!--Menú instructor-->
                @if(Auth::user()->havePermission('agroindustria.instructor.production'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.production')}}">Producción</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.deliveries'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.movements')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.labor'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.activity'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.activity')}}">{{trans('agroindustria::menu.Activities')}}</a>
                    </li>
                @endif  

                @if(Auth::user()->havePermission('agroindustria.instructor.formulations'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.formulations')}}">{{trans('agroindustria::formulations.Recipes')}}</a>
                    </li>
                @endif
               {{-- Menu storer --}}
            @endif
            @if(Route::is('*storer.*'))
                @if(Auth::user()->havePermission('agroindustria.storer.crud'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.storer.inventory')}}">{{trans('agroindustria::menu.Inventory')}}</a>
                    </li>
                @endif
                @if(Auth::user()->havePermission('agroindustria.storer.view.request'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.storer.view.request')}}">Solicitudes</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
        
     <!-- Dashboard unidades -->
     @if(auth()->check() && checkRol('agroindustria.instructor.vilmer') || auth()->check() && checkRol('agroindustria.instructor.chocolate'))  
     <div class="dashboard_units">  
         <ul class="dashboard">
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('cefa.agroindustria.instructor.units') }}">{{trans('agroindustria::menu.Units')}}</a>
             </li>
         </ul>
         @endif
     </div>

    <!-- Dashboard admin -->
    @if(auth()->check() && checkRol('agroindustria.admin'))  
    <div class="dashboard_admin">  
        <ul class="dashboard">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.agroindustria.admin.dashboard') }}">{{trans('agroindustria::menu.Dashboard')}}</a>
            </li>
        </ul>
    </div>
    @endif
    <!-- Traduccion -->
    <div class="dropdown_lang">
        <button class="dropbtn" onclick="toggleDropdown()"> {{ session('lang') }} <i class="fas fa-globe"></i></button>
        <div id="myDropdown" class="dropdown-content">
            <a href="{{ url('lang',['es']) }}">Español</a>
            <a href="{{ url('lang',['en']) }}">English</a>
        </div>
    </div>
    
    
    <!-- Perfil, login, volver a sicefa -->
    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
      <div class="row col-md-12">
          <div class="image mt-2 mb-2">
              <div class="dropdown">  
                  <a href="#" class="dropdown" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="img_login">
                      @if(isset(Auth::user()->person->avatar))
                      <img src="{{ asset(Auth::user()->person->avatar) }}" id="img" class="img-circle elevation-2" alt="User Image">
                      @else
                      <img src="{{ asset('modules/sica/images/blanco.png') }}" id="img" class="img-circle elevation-2" alt="User Image" width="5px">
                      @endif
                    </div>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="userDropdown" id="menu">
                      @guest
                      <div class="col info info-user">
                          <div class="welcome">{{ trans('menu.Welcome') }}</div>
                          <div class="login"><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                      </div>
                      <div class="col info float-right mt-2" id="icon_login" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a></div>
                      @else
                      <div class="col info info-user">
                          <div class="nickname" data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
                          <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
                      </div>
                      <div id="logout" class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}"><a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-lg"></i></a>
                      </div>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                       </form>
                       @endguest
                       <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
                        <i class="fas fa-puzzle-piece" id="sicefa"></i>
                        <span id="volver-sicefa">Volver a Sicefa</span>
                      </a>
                      </div>
                </div>
            </div>
        </div>
  </div>
</nav>
