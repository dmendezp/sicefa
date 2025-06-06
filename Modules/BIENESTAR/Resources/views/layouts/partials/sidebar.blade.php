<div class="sidebar-color">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cefa.bienestar.home') }}" class="brand-link" style="text-decoration: none; display: flex; align-items: center;">
      <i class="fas fa-hand-holding-heart" style="color: #ffffff; font-size: 60px; margin-right: 10px;"></i>
      <div>
        <span class="brand-text font-weight-dark" id="logo">{{ trans('bienestar::menu.Welfare')}}</span><br>
        <span class="brand-text font-weight-dark" id="logo">{{ trans('bienestar::menu.Apprentice')}}</span>
      </div>
    </a><br>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Línea separadora -->
      <hr class="sidebar-divider">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-1 d-flex">
        <div class="image mt-2 mb-2">
          @if (isset(Auth::user()->person->avatar))
          <img src="{{ asset('storage/' . Auth::user()->person->avatar) }}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset('modules/sica/images/blanco.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        @guest
        <div class="col info info-user">
          <div>{{ trans('menu.Welcome') }}</div>
          <div><a href="{{ route('login') }}" class="d-block" style="text-decoration: none">{{ trans('Auth.Login') }}</a></div>

        </div>
        <div class="col info float-right mt-2" data-toggle="tooltip" data-placement="right" title="{{ trans('Auth.Login') }}">
          <a href="{{ route('login') }}" class="d-block" style="text-decoration: none"><i class="fas fa-sign-in-alt"></i></a>
        </div>
        @else
        <div class="col info info-user">
          <div data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->person->first_name }} {{ Auth::user()->person->first_last_name }} {{ Auth::user()->person->second_last_name }}">
            {{ Auth::user()->nickname }}
          </div>
          <div class="small">
            <em> {{ Auth::user()->roles->count() > 0 ? Auth::user()->roles[0]->name : 'Sin rol asignado' }} </em>
          </div>
        </div>
        <div class="col-auto info float-right mt-2">
          <a href="{{ route('logout') }}" class="d-block custom-color" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ trans('ptventa::general.ExitSession') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        @endguest
      </div>

      <!-- Enlace "Volver a Sicefa" -->
      <div class="user-panel ">
        <nav class="">
          <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
              <a href="{{ route('cefa.welcome') }}" class="nav-link">
                <i class="fas fa-puzzle-piece"></i>
                <p>{{ trans('bienestar::menu.Back to Sicefa')}}</p>
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
          <!-- menu Admin -->
          @if(Route::is('bienestar.admin.*'))
          @if(Auth::user()->havePermission('bienestar.admin.crud.benefits'))
          <li class="nav-item">
            <a href="{{ route('bienestar.admin.crud.benefits') }}" class="nav-link {{ !Route::is('bienestar.admin.crud.benefits') ?: 'sactive' }}"><i class="fas fa-handshake"></i>
              <p>{{ trans('bienestar::menu.Benefits')}}</i></p>
            </a>
          </li>
          @endif
          <li class="nav-item {{ !Route::is('bienestar.admin.food.*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link">
              <i class="fas fa-pizza-slice"></i>
              <p>{{ trans('bienestar::menu.Feeding')}} <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.admin.food.crud.beneficiaries_food'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.food.crud.beneficiaries_food') }}" class="nav-link {{ !Route::is('bienestar.admin.food.crud.beneficiaries_food') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Food Beneficiaries')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.food.view.food_assistance'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.food.view.food_assistance') }}" class="nav-link {{ !Route::is('bienestar.admin.food.view.food_assistance') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Take Assistance')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.food.view.food_assistance_lists'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.food.view.food_assistance_lists') }}" class="nav-link {{ !Route::is('bienestar.admin.food.view.food_assistance_lists') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Attendance Listings')}}</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item {{ !Route::is('bienestar.admin.transportation.*') ?: 'menu-is-opening menu-open' }}">
            <a href="#" class="nav-link">
              <i class="fas fa-bus"></i>
              <p>{{ trans('bienestar::menu.Transportation')}} <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.admin.transportation.crud.drivers'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.transportation.crud.drivers') }}" class="nav-link {{ !Route::is('bienestar.admin.transportation.crud.drivers') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Drivers')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.transportation.crud.buses'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.transportation.crud.buses') }}" class="nav-link {{ !Route::is('bienestar.admin.transportation.crud.buses') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Buses')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.transportation.crud.transportroutes'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.transportation.crud.transportroutes') }}" class="nav-link {{ !Route::is('bienestar.admin.transportation.crud.transportroutes') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Routes')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.transportation.view.assing_form_transportation_routes'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.transportation.view.assing_form_transportation_routes') }}" class="nav-link {{ !Route::is('bienestar.admin.transportation.view.assing_form_transportation_routes') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Assign Routes')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.transportation.view.asistance_transport'))
              <li class="nav-item has-treeview">
                <a href="{{route('bienestar.admin.transportation.view.asistance_transport')}}" class="nav-link {{ !Route::is('bienestar.admin.transportation.view.asistance_transport') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Take Assistance')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.transportation.view.transportation_assistance_lists'))
              <li class="nav-item has-treeview">
                <a href="{{route('bienestar.admin.transportation.view.transportation_assistance_lists')}}" class="nav-link {{ !Route::is('bienestar.admin.transportation.view.transportation_assistance_lists') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Attendance Listings')}}</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item {{ !Route::is('bienestar.admin.convocations.*') ?: 'menu-is-opening menu-open' }} has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>{{ trans('bienestar::menu.Convoctions')}}<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.admin.convocations.crud.convocations'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.convocations.crud.convocations')}}" class="nav-link {{ !Route::is('bienestar.admin.convocations.crud.convocations') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Convoctions')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.admin.convocations.crud.editform'))
              <li class="nav-item">
                <a href="{{ route('bienestar.admin.convocations.crud.editform') }}" class="nav-link {{ !Route::is('bienestar.admin.convocations.crud.editform') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Forms')}}</p>
                </a>
              </li>
              @endif
            </ul>
            @if(Auth::user()->havePermission('bienestar.admin.view.postulation-management'))
          <li class="nav-item has-treeview">
            <a href="{{route('bienestar.admin.view.postulation-management')}}" class="nav-link {{ !Route::is('bienestar.admin.view.postulation-management') ?: 'sactive' }}"><i class="fas fa-thumbs-up"></i>
              <p>{{ trans('bienestar::menu.Manage Applications')}}</p>
            </a>
          </li>
          @endif
          </li>
          @endif
          <!-- /.menu Admin -->
          <!--Menu Lider Alimentacions-->
          @if(Route::is('bienestar.food_benefits_leaders.*'))
          @if(Auth::user()->havePermission('bienestar.food_benefits_leaders.crud.benefits'))
          <li class="nav-item">
            <a href="{{ route('bienestar.food_benefits_leaders.crud.benefits') }}" class="nav-link {{ !Route::is('bienestar.food_benefits_leaders.crud.benefits') ?: 'sactive' }}"><i class="fas fa-handshake"></i>
              <p>{{ trans('bienestar::menu.Benefits')}}</i></p>
            </a>
          </li>
          @endif
          <li class="nav-item {{ !Route::is('bienestar.food_benefits_leaders.food.*') ?: 'menu-is-opening menu-open' }} has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-pizza-slice"></i>
              <p>{{ trans('bienestar::menu.Feeding')}} <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.food_benefits_leaders.food.crud.beneficiaries_food'))
              <li class="nav-item">
                <a href="{{ route('bienestar.food_benefits_leaders.food.crud.beneficiaries_food') }}" class="nav-link {{ !Route::is('bienestar.food_benefits_leaders.food.crud.beneficiaries_food') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Food Beneficiaries')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.food_benefits_leaders.food.view.food_assistance'))
              <li class="nav-item">
                <a href="{{ route('bienestar.food_benefits_leaders.food.view.food_assistance') }}" class="nav-link {{ !Route::is('bienestar.food_benefits_leaders.food.view.food_assistance') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Take Assistance')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.food_benefits_leaders.food.view.food_assistance_lists'))
              <li class="nav-item">
                <a href="{{ route('bienestar.food_benefits_leaders.food.view.food_assistance_lists') }}" class="nav-link {{ !Route::is('bienestar.food_benefits_leaders.food.view.food_assistance_lists') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Attendance Listings')}}</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if(Auth::user()->havePermission('bienestar.food_benefits_leaders.view.postulation-management'))
          <li class="nav-item has-treeview">
            <a href="{{route('bienestar.food_benefits_leaders.view.postulation-management')}}" class="nav-link {{ !Route::is('bienestar.food_benefits_leaders.view.postulation-management') ?: 'sactive' }}"><i class="fas fa-thumbs-up"></i>
              <p>{{ trans('bienestar::menu.Manage Applications')}}</p>
            </a>
          </li>
          @endif
          @endif

          <!--menu Lider Transporte-->
          @if(Route::is('bienestar.transportation_benefits_leader.*'))
          @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.crud.benefits'))
          <li class="nav-item">
            <a href="{{ route('bienestar.transportation_benefits_leader.crud.benefits') }}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.crud.benefits') ?: 'sactive' }}"><i class="fas fa-handshake"></i>
              <p>{{ trans('bienestar::menu.Benefits')}}</i></p>
            </a>
          </li>
          @endif
          <li class="nav-item {{ !Route::is('bienestar.transportation_benefits_leader.transportation.*') ?: 'menu-is-opening menu-open' }} has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-bus"></i>
              <p>{{ trans('bienestar::menu.Transportation')}} <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.crud.drivers'))
              <li class="nav-item">
                <a href="{{ route('bienestar.transportation_benefits_leader.transportation.crud.drivers') }}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.crud.drivers') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Drivers')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.crud.buses'))
              <li class="nav-item">
                <a href="{{ route('bienestar.transportation_benefits_leader.transportation.crud.buses') }}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.crud.buses') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Buses')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.crud.transportroutes'))
              <li class="nav-item">
                <a href="{{ route('bienestar.transportation_benefits_leader.transportation.crud.transportroutes') }}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.crud.transportroutes') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Routes')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.view.assing_form_transportation_routes'))
              <li class="nav-item">
                <a href="{{ route('bienestar.transportation_benefits_leader.transportation.view.assing_form_transportation_routes') }}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.view.assing_form_transportation_routes') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Assign Routes')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.view.asistance_transport'))
              <li class="nav-item has-treeview">
                <a href="{{route('bienestar.transportation_benefits_leader.transportation.view.asistance_transport')}}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.view.asistance_transport') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Take Assistance')}}</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.transportation.view.transportation_assistance_lists'))
              <li class="nav-item has-treeview">
                <a href="{{route('bienestar.transportation_benefits_leader.transportation.view.transportation_assistance_lists')}}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.transportation.view.transportation_assistance_lists') ?: 'sactive' }}">
                  <p>{{ trans('bienestar::menu.Attendance Listings')}}</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if(Auth::user()->havePermission('bienestar.transportation_benefits_leader.view.postulation-management'))
          <li class="nav-item has-treeview">
            <a href="{{route('bienestar.transportation_benefits_leader.view.postulation-management')}}" class="nav-link {{ !Route::is('bienestar.transportation_benefits_leader.view.postulation-management') ?: 'sactive' }}"><i class="fas fa-thumbs-up"></i>
              <p>{{ trans('bienestar::menu.Manage Applications')}}</p>
            </a>
          </li>
          @endif
          @endif
          <!--Menu Publico -->
          @if(Route::is('cefa.bienestar.*'))
          <li class="nav-item has-treeview">
            <a href="{{route('cefa.bienestar.postulations')}}" class="nav-link"><i class="fas fa-thumbs-up"></i>
              <p>{{ trans('bienestar::menu.Postulation')}}</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('cefa.bienestar.callconsultation')}}" class="nav-link"><i class="fas fa-search"></i>
              <p>{{ trans('bienestar::menu.Consultation')}}</p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>