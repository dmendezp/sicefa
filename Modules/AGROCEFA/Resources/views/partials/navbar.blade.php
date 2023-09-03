<body style="background-color: #e4e9f7 ">
<div class="navbar">
  @if (Auth::check() && (Auth::user()->roles[0]->name === 'Administrador' || Auth::user()->roles[0]->name === 'Pasante'))
  <ul>
      <li style="margin-left: 40px;margin-right: 170px"><a href="#" id="an">AGROCEFA-{{ Session::get('selectedUnitName') }}</a></li>
      <li style="margin-right: 240px"><a href="{{ route('agrocefa.index') }}" id="an">{{ trans('agrocefa::universal.Home')}}</a></li>
      <li style="margin-right: 40px"><a href="{{ url('lang',['en']) }}" id="an" class="dropdown-item"><img src="{{asset('agrocefa/images/general/en.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English')}}</a></li>
      <li style="margin-right: 20px"><a href="{{ url('lang',['es']) }}" id="an" class="dropdown-item"><img src="{{asset('agrocefa/images/general/es.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish')}}</a></li>
  </ul>
  @else
  <ul>
    <li style="margin-left: 40px;margin-right: 200px"><a href="#" id="an">AGROCEFA</a></li>
    <li style="margin-right: 400px"><a href="{{ route('agrocefa.index') }}" id="an">{{ trans('agrocefa::universal.Home')}}</a></li>
    <li style="margin-right: 40px"><a href="{{ url('lang',['en']) }}" id="an" class="dropdown-item"><img src="{{asset('agrocefa/images/general/en.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English')}}</a></li>
    <li style="margin-right: 40px"><a href="{{ url('lang',['es']) }}" id="an" class="dropdown-item"><img src="{{asset('agrocefa/images/general/es.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish')}}</a></li>
    
</ul>
@endif
  <div class="profile" style="margin-left: 20px; margin-right: 20px;">
      <div class="user-info">
        <div class="profile-img-container">
        @auth
            @if (isset(Auth::user()->person->avatar))
                <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="profile-img img-circle elevation-2" alt="User Image">
            @else
                <img  src="{{ asset('sica/images/blanco.png') }}" class="profile-img img-circle elevation-2" alt="User Image">
            @endif
        @endauth
        </div>
        <div class="profile-text">
        @auth
          <a href="#" class="profile-link" data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
            {{ Auth::user()->nickname }}
          </a>
          @if (Auth::check() && (Auth::user()->roles[0]->name === 'Pasante'))
            <em style="margin-left: 32px" class="profile-role">{{ Auth::user()->roles[0]->name }}</em>
          @else
          <em  class="profile-role">{{ Auth::user()->roles[0]->name }}</em>
          @endif
        @endauth
        </div>
      </div>
      @auth

      <a href="{{ route('logout') }}" id="logout" title="Salir" class="logout-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
                
      @endauth
  </div>
</div>


@yield('selectproductive')
</body>
