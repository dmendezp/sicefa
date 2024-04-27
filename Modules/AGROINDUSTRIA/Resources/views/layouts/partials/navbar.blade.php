<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:rgb(247, 244, 244); margin-bottom:20px; display: flex; justify-content: space-between;  align-items: center;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div  class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a style="width: 260px;" class="navbar-brand" id="title" href="{{ route('cefa.agroindustria.home.index') }}">
            @if (session('viewing_unit'))
                AGROINDUSTRIA - {{ session('viewing_unit_name') }}
            @else
                AGROINDUSTRIA
            @endif
        </a>
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
            
            @if (Route::is('*admin.units.*') && auth()->check() && (checkRol('agroindustria.admin')))
                     
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.activity', ['unit'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Activities')}}</a>
                </li>        
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.view.request')}}">{{trans('agroindustria::menu.Request for supplies')}}</a>
                </li>        
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.admin.units.movements.table')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{trans('agroindustria::menu.reports')}}
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->havePermission('agroindustria.admin.units.production'))
                        <li >
                            <a class="dropdown-item" href="{{route('agroindustria.admin.units.production')}}">{{trans('agroindustria::menu.production')}}</a>
                        </li>
                        @endif
                        @if(Auth::user()->havePermission('agroindustria.admin.units.inventory'))
                        <li >
                            <a class="dropdown-item" href="{{route('agroindustria.admin.units.inventory', ['id'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Inventory')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('agroindustria.admin.units.remove.view')}}" class="nav-link">{{trans('agroindustria::menu.Desregistrations')}}</a>
                </li>
            @endif

            @if(Route::is('*instructor.units.*') && auth()->check() && (checkRol('agroindustria.instructor.vilmer') || checkRol('agroindustria.instructor.chocolate') || checkRol('agroindustria.instructor.cerveceria') || checkRol('superadmin')))
                <!--Menú instructor-->
                @if(Auth::user()->havePermission('agroindustria.instructor.units.activity'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agroindustria.instructor.units.activity', ['unit'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Activities')}}</a>
                    </li>
                @endif
                @if(Auth::user()->havePermission('agroindustria.instructor.units.formulations'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agroindustria.instructor.units.formulations')}}">{{trans('agroindustria::formulations.Recipes')}}</a>
                    </li>
                @endif
     
                @if(Auth::user()->havePermission('agroindustria.instructor.units.labor'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.instructor.units.labor')}}">{{trans('agroindustria::menu.Task')}}</a>
                </li>
                @endif

                @if(Auth::user()->havePermission('agroindustria.instructor.units.movements.table'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.instructor.units.movements.table')}}">{{trans('agroindustria::menu.Movements')}}</a>
                </li>
                @endif

                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.instructor.units.view.request')}}">{{trans('agroindustria::menu.Request for supplies')}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{trans('agroindustria::menu.reports')}}
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->havePermission('agroindustria.instructor.units.production'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('agroindustria.instructor.units.production')}}">{{trans('agroindustria::menu.production')}}</a>
                        </li>
                        @endif
                        @if(Auth::user()->havePermission('agroindustria.instructor.units.inventory'))
                        <li >
                            <a class="dropdown-item" href="{{route('agroindustria.instructor.units.inventory', ['id'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Inventory')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
            {{-- Menu storer --}}
            @if(Route::is('*storer.units.*') &&  auth()->check() && (checkRol('agroindustria.almacenista')))  
                @if(Auth::user()->havePermission('agroindustria.storer.units.inventory'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agroindustria.storer.units.inventory', ['id'=> (session('viewing_unit'))])}}">{{trans('agroindustria::menu.Inventory')}}</a>
                    </li>
                @endif
                @if(Auth::user()->havePermission('agroindustria.storer.units.view.request'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agroindustria.storer.units.view.request')}}">{{trans('agroindustria::menu.requests')}}</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
        
    <!-- Dashboard unidades admin -->
    @if(auth()->check() && (checkRol('agroindustria.admin')))  
    <div class="dashboard_admin">  
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agroindustria.admin.units') }}">Administrador</a>
            </li>
        </ul>
    </div>
    @endif

     <!-- Dashboard unidades instructor -->
     @if(auth()->check() && (checkRol('agroindustria.instructor.vilmer') || checkRol('agroindustria.instructor.chocolate')  || checkRol('agroindustria.instructor.cerveceria')))  
     <div class="dashboard_units">  
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('agroindustria.instructor.units') }}">Instructor</a>
             </li>
         </ul>
        </div>
    @endif

    @if(auth()->check() && (checkRol('agroindustria.almacenista')))  
    <div class="dashboard_storer">  
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agroindustria.storer.units') }}">Almacenista</a>
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
                          <div class="login"><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                      </div>
                      <div class="col info float-right mt-2" id="icon_login" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login', ['redirect' => url()->current()]) }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a></div>
                      <a href="{{ route ('cefa.agroindustria.home.manual')}}" class="nav-link" id="question">
                        <i class="fas fa-question-circle"></i>
                        <span id="volver-sicefa">Manual de Usuario</span>
                      </a>                    
                      @else
                      @if(Auth::user()->roles == null || count(Auth::user()->roles) == 0)
                      <div class="col info info-user">
                          <div class="nickname" data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
                          <div class="small"><em> Aún no tienes un rol asignado</em></div>
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
                        @endif  
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
