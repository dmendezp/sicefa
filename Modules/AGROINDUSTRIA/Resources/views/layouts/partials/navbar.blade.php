<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:rgb(247, 244, 244); margin-bottom:20px; display: flex; justify-content: space-between;  align-items: center;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" id="title" href="{{ route('cefa.agroindustria.home.index') }}">
        @if (session('viewing_unit'))
            AGROINDUSTRIA - {{ session('viewing_unit_name') }}
        @else
            AGROINDUSTRIA
        @endif
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Acceso general -->
            @if(Route::is('*home.*'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.home.index')}}">{{trans('agroindustria::menu.Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.home.formulations.recipes')}}">{{trans('agroindustria::menu.Products')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.home.developments')}}">{{trans('agroindustria::menu.developments')}}</a>
                </li>
                
            @endif
            
            @if(auth()->check() && checkRol('agroindustria.admin') & Route::is('*units.*'))                       
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.activity', ['unit'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Activities')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.production')}}">{{trans('agroindustria::menu.production')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.movements')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.storer.units.inventory', ['id'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Inventory')}}</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('cefa.agroindustria.admin.units.remove')}}" class="nav-link">{{trans('agroindustria::menu.Desregistrations')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.requests')}}">Solicitud de Insumos</a>
                </li>
            @endif

            @if(Route::is('*units.*') && auth()->check() && checkRol('agroindustria.instructor.vilmer') || auth()->check() && checkRol('agroindustria.instructor.chocolate'))
                <!--Menú instructor-->
                @if(Auth::user()->havePermission('agroindustria.instructor.units.activity'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agroindustria.instructor.units.activity', ['unit'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Activities')}}</a>
                    </li>
                @endif  

                @if(Auth::user()->havePermission('agroindustria.instructor.formulations'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.formulations')}}">{{trans('agroindustria::formulations.Recipes')}}</a>
                    </li>
                @endif
     
                @if(Auth::user()->havePermission('agroindustria.instructor.units.labor'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.instructor.units.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.units.movements'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.instructor.units.movements')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.units.production'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.production')}}">{{trans('agroindustria::menu.production')}}</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cefa.agroindustria.units.instructor.requests')}}">Solicitud de Insumos</a>
                </li>
            @endif
            {{-- Menu storer --}}
            @if(auth()->check() && checkRol('agroindustria.almacenista') && Route::is('*units.*'))  
                @if(Auth::user()->havePermission('agroindustria.storer.crud'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.storer.units.inventory', ['id'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Inventory')}}</a>
                    </li>
                @endif
                @if(Auth::user()->havePermission('agroindustria.storer.view.request'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cefa.agroindustria.storer.units.view.request')}}">{{trans('agroindustria::menu.requests')}}</a>
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
                 <a class="nav-link" href="{{ route('agroindustria.instructor.units') }}">{{trans('agroindustria::menu.Units')}}</a>
             </li>
         </ul>
        </div>
    @endif

    <!-- Dashboard admin -->
    @if(auth()->check() && checkRol('agroindustria.admin'))  
    <div class="dashboard_admin">  
        <ul class="dashboard">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agroindustria.admin.units') }}">{{trans('agroindustria::menu.Units')}}</a>
            </li>
        </ul>
    </div>
    @endif

    @if(auth()->check() && checkRol('agroindustria.almacenista'))  
    <div class="dashboard_admin">  
        <ul class="dashboard">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cefa.agroindustria.units') }}">{{trans('agroindustria::menu.Units')}}</a>
            </li>
        </ul>
    </div>
    @endif
    <!-- Traduccion -->
    <li class="dropdown_lang" style="position: relative; right: 80px; list-style-type: none;">
        <a class="nav-link scrollto" data-toggle="dropdown_lang" href="#">
          {{ session('lang') }} <i class="fas fa-globe"></i>
        </a>
        <ul>
          <li><a href="{{ url('lang',['es']) }}" class="dropdown-item scrollto">Español</a></li>
          <li><a href="{{ url('lang',['en']) }}" class="dropdown-item scrollto">Ingles</a></li>
        </ul>
    </li>
    
    
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
                      <a href="{{ route ('cefa.agroindustria.home.manual')}}" class="nav-link" id="question">
                        <i class="fas fa-question-circle"></i>
                        <span id="volver-sicefa">Manual de Usuario</span>
                      </a>                    
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
                       <a href="{{ route ('cefa.agroindustria.home.manual')}}" class="nav-link" id="question">
                            <i class="fas fa-question-circle"></i>
                            <span id="volver-sicefa">Manual de Usuario</span>
                        </a>   
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