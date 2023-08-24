<nav class="navbar navbar-expand-lg navbar-Dark" style="background-color:rgb(247, 244, 244); margin-bottom:20px">
    <a class="navbar-brand" id="title" href="#">AGROINDUSTRIA</a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse d-sm-flex" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('agroindustria.intern.index')}}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('agroindustria.intern.invb')}}">Unidades</a>
            </li>
            <li class="nav-item">
                <style>
                    /* Estilos para el menú desplegable */
                    .dropdown {
                      position: relative;
                      display: inline-block;
                    }
                
                    .dropdown-content {
                      display: none;
                      position: absolute;
                      background-color: #f9f9f9;
                      min-width: 160px;
                      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                      z-index: 1;
                    }
                
                    .dropdown:hover .dropdown-content {
                      display: block;
                    }
                
                    /* Estilos opcionales para los elementos del menú */
                    .dropdown-content a {
                      color: black;
                      padding: 12px 16px;
                      text-decoration: none;
                      display: block;
                    }
                
                    .dropdown-content a:hover {
                      background-color: #f1f1f1;
                    }
                  </style>
                </head>
                <body>
                
                <div class="dropdown">
                  <button class="dropbtn">Menú</button>
                  <div class="dropdown-content">
                    <a href="{{route('agroindustria.intern.binsu')}}">Insumos</a>
                    <a href="{{route('agroindustria.intern.baseo')}}">Aseo</a>
                    <a href="{{route('agroindustria.intern.benvas')}}">Envases</a>
                    <a href="{{route('agroindustria.intern.bepp')}}">Epp</a>

                </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
      <div class="row col-md-12">
          <div class="image mt-2 mb-2">
              <div class="dropdown">
                  <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if(isset(Auth::user()->person->avatar))
                      <img src="{{ asset(Auth::user()->person->avatar) }}" id="img" class="img-circle elevation-2" alt="User Image">
                      @else
                      <img src="{{ asset('sica/images/blanco.png') }}" id="img" class="img-circle elevation-2" alt="User Image" width="5px">
                      @endif
                  </a>
                  <div class="dropdown-menu" aria-labelledby="userDropdown" id="menu">
                      @guest
                      <div class="col info info-user">
                        <div class="image_login">
                            @if(isset(Auth::user()->person->avatar))
                            <img src="{{ asset(Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
                            @else
                            <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
                            @endif
                        </div>
                          <div class="welcome">{{ trans('menu.Welcome') }}</div>
                          <div class="login"><a href="{{ route('login') }}" class="d-block">{{ trans('Auth.Login') }}</a></div>
                      </div>
                      <div class="col info float-right mt-2" id="icon_login" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}"><a href="{{ route('login') }}" class="d-block" ><i class="fas fa-sign-in-alt"></i></a></div>
                      @else
                      <div class="col info info-user">
                        <div class="image_logout">
                            @if(isset(Auth::user()->person->avatar))
                            <img src="{{ asset(Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
                            @else
                            <img src="{{ asset('sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image" width="5px">
                            @endif
                        </div>
                          <div class="nickname" data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">{{ Auth::user()->nickname }}</div>
                          <div class="small"><em> {{ Auth::user()->roles[0]->name }}</em></div>
                      </div>
                      <div class="col info float-right mt-2" id="icon_logout" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Logout') }}">
                        <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i id="logout" class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
                            <i class="fas fa-puzzle-piece" id="sicefa"></i>
                            <span id="volver-sicefa">Volver a Sicefa</span>
                        </a>
                    </div>
                      @endguest
                  </div>
              </div>
          </div>
      </div>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
  </form>
  
</nav>
