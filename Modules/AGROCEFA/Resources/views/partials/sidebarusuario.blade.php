<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <!--<img src="logo.png" alt="">-->
            </span>

            <div class="text logo-text">
    <span class="profession text-center" ><center><i class="fas fa-tractor"></center></i></span>
                <span class="name">AGROCEFA</span> 
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-home icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Home')}}</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{route('agrocefa.inventory')}}">
                        <i class='bx bx-lemon icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Production')}}</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{route('agrocefa.bodegas')}}">
                        <i class='bx bx-code icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Developers')}}</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{route('agrocefa.insumos')}}">
                        <i class='bx bx-search-alt-2 icon' ></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.AGROCEFA?')}}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
            <a href="{{ route('login')}}">
            <i class='bx bx-lock-open icon'></i>
            <span class="text nav-text">login</span>
            </a>
            </li>
            <li class="">
                <a href="{{ route('cefa.welcome')}}">
                    <i class='bx bx-log-out icon' ></i>
                    <span class="text nav-text">SICEFA</span>
                </a>
            </li> 
        </div>
    </div>

</nav>
