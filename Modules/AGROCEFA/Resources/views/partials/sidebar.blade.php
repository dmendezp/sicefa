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
                    <a href="{{ route('agrocefa.inventory')}}">
                        <i class='bx bx-list-plus icon'></i>
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
                      <li id="sublist-li"><a href="#"><i class='bx bxl-apple icon' ></i><span class="text nav-text">{{ trans('agrocefa::universal.Consumption')}}</span></a></li>
                      <li id="sublist-li"><a href="#"><i class='bx bx-lemon icon' ></i><span class="text nav-text">{{ trans('agrocefa::universal.Production')}}</span></a></li>
                      <li id="sublist-li"><a href="#"><i class='bx bx-objects-vertical-bottom icon'></i><span class="text nav-text">{{ trans('agrocefa::universal.Balance')}}</span></a></li>
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
    const reportLinks = document.querySelectorAll('.nav-link.reports');

    reportLinks.forEach(reportLink => {
        const subList = reportLink.querySelector('.sub-list');

        reportLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Si la sub-lista ya está abierta, ciérrala y restablece el margen superior
            if (subList.style.display === 'block') {
                subList.style.display = 'none';
                reportLink.classList.remove('active');
                const nextLink = reportLink.nextElementSibling;
                if (nextLink && nextLink.classList.contains('nav-link')) {
                    nextLink.style.marginTop = '0';
                }
            } else {
                // Cerrar todas las sub-listas y clases activas antes de abrir una nueva
                reportLinks.forEach(link => {
                    link.classList.remove('active');
                    link.querySelector('.sub-list').style.display = 'none';
                    const nextLink = link.nextElementSibling;
                    if (nextLink && nextLink.classList.contains('nav-link')) {
                        nextLink.style.marginTop = '0';
                    }
                });

                // Abrir la sub-lista actual y ajustar el margen superior del siguiente elemento
                subList.style.display = 'block';
                const nextLink = reportLink.nextElementSibling;
                if (nextLink && nextLink.classList.contains('nav-link')) {
                    const subListHeight = subList.offsetHeight;
                    nextLink.style.marginTop = subListHeight <= 100 ? '80px' : '180px';
                }
                
                reportLink.classList.add('active');
            }
        });
    });
});

</script>
