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
                <li class="nav-link reports">
                    <a href="#">
                      <i class='bx bx-list-plus icon'></i>
                      <span class="text nav-text">{{ trans('agrocefa::universal.Inventory')}}</span>
                      <i class='bx bx-chevron-down arrow icon' id="flecha1"></i>
                    </a>
                    <!-- Agregamos el ul.sub-list dentro del li.nav-link.reports -->
                    <ul class="sub-list">
                      <li><a href="#"><i class='bx bx-sort-alt-2 icon' ></i><span class="text nav-text">{{ trans('agrocefa::universal.Movements')}}</span></a></li>
                    </ul>  
                </li>
    <div class="menu-bar">
        <div class="menu">

            

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Inventory')}}</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{route('agrocefa.inventory')}}">
                        <i class='bx bx-wrench icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Labormanagement')}}</span>
                    </a>
                </li>

                <li class="nav-link reports">
                    <a href="#">
                      <i class='bx bx-file icon'></i>
                      <span class="text nav-text">{{ trans('agrocefa::universal.Reports')}}</span>
                      <i class='bx bx-chevron-down arrow icon' id="flecha2"></i>
                    </a>
                    <!-- Agregamos el ul.sub-list dentro del li.nav-link.reports -->
                    <ul class="sub-list">
                      <li><a href="#"><i class='bx bxl-apple icon' ></i><span class="text nav-text">{{ trans('agrocefa::universal.Consumption')}}</span></a></li>
                      <li><a href="#"><i class='bx bx-lemon icon' ></i><span class="text nav-text">{{ trans('agrocefa::universal.Production')}}</span></a></li>
                      <li><a href="#"><i class='bx bx-objects-vertical-bottom icon'></i><span class="text nav-text">{{ trans('agrocefa::universal.Balance')}}</span></a></li>
                    </ul>  
                </li>
                <li class="nav-link">
                    <a href="{{route('agrocefa.parameters')}}">
                        <i class='bx bx-hive icon'></i>
                        <span class="text nav-text">{{ trans('agrocefa::universal.Parameters')}}</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const reportLink = document.querySelector('.nav-link.reports');
  const subList = reportLink.querySelector('.sub-list');

  reportLink.addEventListener('click', function(event) {
    event.preventDefault();
    subList.style.display = subList.style.display === 'block' ? 'none' : 'block';
  });
});
</script>
