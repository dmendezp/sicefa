<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <!--<img src="logo.png" alt="">-->
            </span>

            <div class="text logo-text">
                <span class="profession text-center">   
                    <center><i class="fas fa-tractor"></center></i>
                </span>
                <span class="name">AGROCEFA</span>

            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                @if (Route::is('agrocefa.trainer.*'))
                    @if (Auth::user()->havePermission('agrocefa.trainer.parameters.index'))
                    <li class="nav-link">
                        <a href="{{ route('agrocefa.trainer.parameters.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.parameters.*') ?: 'active' }}">
                            <i class='bx bx-hive icon {{ !Route::is('agrocefa.trainer.parameters.index') ?: 'active' }}'></i>
                            <span class="text nav-text {{ !Route::is('agrocefa.trainer.parameters.index') ?: 'active' }}">{{ trans('agrocefa::universal.Parameters') }}</span>
                        </a>
                    </li>
                    
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.trainer.labormanagement.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.trainer.labormanagement.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.labormanagement.*') ?: 'active' }}">
                                <i class='bx bx-wrench icon {{ !Route::is('agrocefa.trainer.labormanagement.*') ?: 'active' }}'></i>
                                <span class="text nav-text {{ !Route::is('agrocefa.trainer.labormanagement.*') ?: 'active' }}">{{ trans('agrocefa::universal.Labormanagement') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.trainer.reports.index'))
                        <li class="nav-link reports">
                            <a href="#" class="side-link {{ !Route::is('agrocefa.trainer.reports.*') ?: 'active' }}">
                                <i class='bx bx-file icon {{ !Route::is('agrocefa.trainer.reports.*') ?: 'active' }}'></i>
                                <span class="text nav-text {{ !Route::is('agrocefa.trainer.reports.*') ?: 'active' }}">{{ trans('agrocefa::universal.Reports') }}</span>
                                <i class='bx bx-chevron-down arrow icon' id="flecha2"></i>
                            </a>
                            <!-- Agregamos el ul.sub-list dentro del li.nav-link.reports -->
                            <ul class="sub-list">
                                <li id="sublist-li">
                                    <a href="{{ route('agrocefa.trainer.reports.consumable.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.reports.consumable.*') ?: 'active' }}">
                                        <i class='bx bxl-apple icon {{ !Route::is('agrocefa.trainer.reports.consumable.*') ?: 'active' }}'></i>
                                        <span class="text nav-text {{ !Route::is('agrocefa.trainer.reports.consumable.*') ?: 'active' }}">{{ trans('agrocefa::universal.Consumption') }}</span>
                                    </a>
                                </li>
                                <li id="sublist-li">
                                    <a href="{{ route('agrocefa.trainer.reports.balance.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.reports.balance.*') ?: 'active' }}">
                                        <i class='bx bx-objects-vertical-bottom icon {{ !Route::is('agrocefa.trainer.reports.balance.*') ?: 'active' }}'></i>
                                        <span class="text nav-text {{ !Route::is('agrocefa.trainer.reports.balance.*') ?: 'active' }}">{{ trans('agrocefa::universal.Balance') }}</span>
                                    </a>
                                </li>
                                <li id="sublist-li">
                                    <a href="{{ route('agrocefa.trainer.reports.production.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.reports.production.*') ?: 'active' }}">
                                        <i class='bx bx-lemon icon {{ !Route::is('agrocefa.trainer.reports.production.*') ?: 'active' }}'></i>
                                        <span class="text nav-text {{ !Route::is('agrocefa.trainer.reports.production.*') ?: 'active' }}">{{ trans('agrocefa::universal.Production') }}</span>
                                    </a>
                                </li>
                                <li id="sublist-li">
                                    <a href="{{ route('agrocefa.trainer.reports.labor.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.reports.labor.*') ?: 'active' }}">
                                        <i class='bx bxs-calculator icon {{ !Route::is('agrocefa.trainer.reports.labor.*') ?: 'active' }}'></i>
                                        <span class="text nav-text {{ !Route::is('agrocefa.trainer.reports.labor.*') ?: 'active' }}">{{ trans('agrocefa::labor.Labors') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.trainer.inventory.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.trainer.inventory.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.inventory.*') ?: 'active' }}">
                                <i class='bx bx-list-plus icon {{ !Route::is('agrocefa.trainer.inventory.*') ?: 'active' }}'></i>
                                <span class="text nav-text {{ !Route::is('agrocefa.trainer.inventory.*') ?: 'active' }}">{{ trans('agrocefa::universal.Inventory') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.trainer.movements.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.trainer.movements.index') }}" class="side-link {{ !Route::is('agrocefa.trainer.movements.*') ?: 'active' }}">
                                <i class='bx bx-transfer-alt icon {{ !Route::is('agrocefa.trainer.movements.*') ?: 'active' }}'></i>
                                <span class="text nav-text {{ !Route::is('agrocefa.trainer.movements.*') ?: 'active' }}">{{ trans('agrocefa::universal.Movements') }}</span>
                            </a>
                        </li>
                    @endif
                @endif

                @if (Route::is('agrocefa.manageragricultural.*'))
                @if (Auth::user()->havePermission('agrocefa.manageragricultural.parameters.index'))
                    <li class="nav-link">
                        <a href="{{ route('agrocefa.manageragricultural.parameters.index') }}">
                            <i class='bx bx-hive icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Parameters') }}</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->havePermission('agrocefa.manageragricultural.labormanagement.index'))
                    <li class="nav-link">
                        <a href="{{ route('agrocefa.manageragricultural.labormanagement.index') }}">
                            <i class='bx bx-wrench icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Labormanagement') }}</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->havePermission('agrocefa.manageragricultural.reports.index'))
                    <li class="nav-link reports">
                        <a href="#">
                            <i class='bx bx-file icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Reports') }}</span>
                            <i class='bx bx-chevron-down arrow icon' id="flecha2"></i>
                        </a>
                        <!-- Agregamos el ul.sub-list dentro del li.nav-link.reports -->
                        <ul class="sub-list">
                            <li id="sublist-li"><a href="{{ route('agrocefa.manageragricultural.reports.consumable.index') }}"><i
                                        class='bx bxl-apple icon'></i><span
                                        class="text nav-text">{{ trans('agrocefa::universal.Consumption') }}</span></a>
                            </li>
                            <li id="sublist-li"><a href="{{ route('agrocefa.manageragricultural.reports.balance.index') }}"><i
                                        class='bx bx-objects-vertical-bottom icon'></i><span
                                        class="text nav-text">{{ trans('agrocefa::universal.Balance') }}</span></a>
                            </li>
                            <li id="sublist-li"><a href="{{ route('agrocefa.manageragricultural.reports.production.index') }}"><i 
                                        class='bx bx-lemon icon'></i><span
                                        class="text nav-text">{{ trans('agrocefa::universal.Production') }}</span></a>
                            </li>
                            <li id="sublist-li"><a href="{{ route('agrocefa.manageragricultural.reports.labor.index') }}"><i
                                        class='bx bxs-calculator icon'></i><span
                                        class="text nav-text">{{ trans('agrocefa::labor.Labors') }}</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->havePermission('agrocefa.manageragricultural.inventory.index'))
                    <li class="nav-link">
                        <a href="{{ route('agrocefa.manageragricultural.inventory.index') }}">
                            <i class='bx bx-list-plus icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Inventory') }}</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->havePermission('agrocefa.manageragricultural.movements.index'))
                    <li class="nav-link">
                        <a href="{{ route('agrocefa.manageragricultural.movements.index') }}">
                            <i class='bx bx-transfer-alt icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Movements') }}</span>
                        </a>
                    </li>
                @endif
            @endif

                @if (Route::is('agrocefa.passant.*'))
                    @if (Auth::user()->havePermission('agrocefa.passant.inventory.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.passant.inventory.index') }}">
                                <i class='bx bx-list-plus icon'></i>
                                <span class="text nav-text">{{ trans('agrocefa::universal.Inventory') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.passant.movements.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.passant.movements.index') }}">
                                <i class='bx bx-transfer-alt icon'></i>
                                <span class="text nav-text">{{ trans('agrocefa::universal.Movements') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.passant.labormanagement.index'))
                        <li class="nav-link">
                            <a href="{{ route('agrocefa.passant.labormanagement.index') }}">
                                <i class='bx bx-wrench icon'></i>
                                <span class="text nav-text">{{ trans('agrocefa::universal.Labormanagement') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->havePermission('agrocefa.passant.reports.index'))
                        <li class="nav-link reports">
                            <a href="#">
                                <i class='bx bx-file icon'></i>
                                <span class="text nav-text">{{ trans('agrocefa::universal.Reports') }}</span>
                                <i class='bx bx-chevron-down arrow icon' id="flecha2"></i>
                            </a>
                            <!-- Agregamos el ul.sub-list dentro del li.nav-link.reports -->
                            <ul class="sub-list">
                                <li id="sublist-li"><a href="{{ route('agrocefa.passant.reports.consumable.index') }}"><i
                                            class='bx bxl-apple icon'></i><span
                                            class="text nav-text">{{ trans('agrocefa::universal.Consumption') }}</span></a>
                                </li>
                                <li id="sublist-li"><a href="{{ route('agrocefa.passant.reports.balance.index') }}"><i
                                            class='bx bx-objects-vertical-bottom icon'></i><span
                                            class="text nav-text">{{ trans('agrocefa::universal.Balance') }}</span></a>
                                </li>
                                <li id="sublist-li"><a href="{{ route('agrocefa.passant.reports.production.index') }}">
                                            <i class='bx bx-lemon icon'></i><span
                                            class="text nav-text">{{ trans('agrocefa::universal.Production') }}</span></a>
                                </li>
                                <li id="sublist-li"><a href="{{ route('agrocefa.passant.reports.labor.index') }}"><i
                                            class='bx bxs-calculator icon'></i><span
                                            class="text nav-text">Labores</span></a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif

                @if (Route::is('cefa.agrocefa.*'))
                    <li class="nav-link">
                        <a href="{{ route('cefa.agrocefa.index') }}">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Home') }}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('cefa.agrocefa.developers.index') }}">
                            <i class='bx bx-code icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.Developers') }}</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('cefa.agrocefa.usuario.index') }}">
                            <i class='bx bx-search-alt-2 icon'></i>
                            <span class="text nav-text">{{ trans('agrocefa::universal.AGROCEFA?') }}</span>
                        </a>
                    </li>

                    {{-- Manual --}}
                    <li class="nav-link">
                        <a href="{{ route('cefa.agrocefa.manual.index') }}">
                            <i class="bx bx-info-circle icon"></i>
                            <span class="text nav-text">MANUAL</span>
                        </a>
                    </li>
            </ul>
        </div>
        
        <div class="bottom-content">
            
            
            @endif

            @if (Auth::check())

                <li class="" style="margin-top: 180px">
                    <a href="{{ route('cefa.welcome') }}">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">SICEFA</span>
                    </a>
                </li>
            @else
            <li style="margin-top: 70px" class="">
                <a href="{{ route('login', ['redirect' => url()->current()]) }}">
                    <i class='bx bx-lock-open icon'></i>
                    <span class="text nav-text">Iniciar Sesión</span>
                </a>
            </li>
            
                <li class="">
                    <a href="{{ route('cefa.welcome') }}">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">SICEFA</span>
                    </a>
                </li>
            @endif
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reportLinks = document.querySelectorAll('.nav-link.reports');

        reportLinks.forEach(reportLink => {
            const subList = reportLink.querySelector('.sub-list');

            reportLink.addEventListener('click', function(event) {
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
                        nextLink.style.marginTop = subListHeight <= 100 ? '80px' : '210px';
                    }

                    // No prevenir el comportamiento predeterminado, lo que permite redirigir
                }
            });
        });
    });
</script>
