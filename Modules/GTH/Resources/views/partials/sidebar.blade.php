<aside class="sidebar" id="sidebar">
    <span class="iconos text-center"><i class="fas fa-user-cog"></i></span>
    <h3 class="text-center" id="spaceh3">GTH</h3>

<<<<<<< HEAD
    <ul>
        @if (Auth::user()->havePermission('cefa.gth.contractors.view'))
      <li><a href="{{route('cefa.gth.contractors.view')}}"><i class="bi bi-file-earmark-medical-fill icon"></i>Contratistas</a></li>
      @endif
      <li><a href="{{route('cefa.gth.contractreports.view')}}"><i class='bx bxs-report icon'></i>Reporte Contratos</a></li>
      <li><a href="{{route('cefa.gth.contractortypes.view')}}"><i class='bx bxs-report icon'></i>Tipo de Contratos</a></li>
      <li><a href="{{route('cefa.gth.employeetypes.view')}}"><i class='bx bxs-report icon'></i>Tipo de Empleados</a></li>
      <li><a href="{{route('cefa.gth.insurerentities.view')}}"><i class='bx bxs-report icon'></i>Entidad Aseguradora</a></li>
      <li><a href="{{route('cefa.gth.pensionentities.view')}}"><i class='bx bxs-report icon'></i>Entidad Pensión</a></li>
      <li><a href="{{route('cefa.gth.position')}}"><i class='bx bxs-report icon'></i>Grados</a></li>
      <li><a href="{{route('cefa.officials.view')}}"><i class='bx bx-street-view icon'></i>Funcionarios</i></a></li>
      <li><a href="{{route('cefa.contractualcertificates.view')}}" style="margin-bottom: 90px"><i class='bx bxs-receipt icon'></i>Certificado Contractual</a></li>
      <li id="space"><a href="{{ route('cefa.welcome')}}"><i class='bx bx-exit icon icon'></i>Sicefa</a></li>

=======
    <ul class="list-unstyled">
        <li class="mb-1">
            <button class="btn btn-link custom-button align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                Dashboard
            </button>
            <div class="collapse custom-menu" id="dashboard-collapse">
                <ul class="list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded">Overview</a></li>
                    <li><a href="#" class="link-dark rounded">Weekly</a></li>
                    <li><a href="#" class="link-dark rounded">Monthly</a></li>
                    <li><a href="#" class="link-dark rounded">Annually</a></li>
                </ul>
            </div>
        </li>
        <li><a href="{{route('cefa.gth.contractors.view')}}"><i class="bi bi-file-earmark-medical-fill icon"></i>Contratistas</a></li>
        <li><a href="{{route('cefa.gth.contractreports.view')}}"><i class='bx bxs-report icon'></i>Reporte Contratos</a></li>
        <li><a href="{{route('cefa.gth.contractortypes.view')}}"><i class='bx bxs-report icon'></i>Tipo de Contratos</a></li>
        <li><a href="{{route('cefa.gth.employeetypes.view')}}"><i class='bx bxs-report icon'></i>Tipo de Empleados</a></li>
        <li><a href="{{route('cefa.gth.insurerentities.view')}}"><i class='bx bxs-report icon'></i>Entidad Aseguradora</a></li>
        <li><a href="{{route('cefa.gth.pensionentities.view')}}"><i class='bx bxs-report icon'></i>Entidad Pensión</a></li>
        <li><a href="{{route('cefa.gth.position')}}"><i class='bx bxs-report icon'></i>Gestion de Posicion</a></li>
        @if (Auth::user()->havePermission('agrocefa.passant.reports'))
        <li><a href="{{route('cefa.officials.view')}}"><i class='bx bx-street-view icon'></i>Funcionarios</a></li>
        @endif
        <li><a href="{{route('cefa.contractualcertificates.view')}}" style="margin-bottom: 90px"><i class='bx bxs-receipt icon'></i>Certificado Contractual</a></li>
        <li id="space"><a href="{{ route('cefa.welcome')}}"><i class='bx bx-exit icon icon'></i>Sicefa</a></li>
>>>>>>> 6d594b5a7276d717011a8ec48b3b9dabb08d2014
    </ul>
</aside>
