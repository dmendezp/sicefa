<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')

<body>
    @csrf
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        @include('senaempresa::layouts.structure.breadcrumb')
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Asociados</div>
                        <div class="card-body">
                            <form action="{{ route('nueva_vacante') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="staff_senaempresa_id" class="form-label">Personal ID</label>
                                    <select class="form-control" name="staff_senaempresa_id"
                                        aria-label="Selecciona Personal ID">
                                        <option value="" selected>Selecciona Personal ID</option>
                                        @foreach ($staff_senaempresas as $staff_senaempresa)
                                            <option value="{{ $staff_senaempresa->id }}">
                                                {{ $staff_senaempresa->id }}
                                                {{ $staff_senaempresa->Apprentice->Person->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="position_company_id" class="form-label">Id Cargo</label>
                                    <select class="form-control" name="position_company_id"
                                        aria-label="Selecciona un Cargo">
                                        <option value="" selected>Selecciona un Cargo</option>
                                        @foreach ($inventories as $inventory)
                                            <option value="{{ $inventory->id }}">
                                                {{ $inventory->id }} {{ $inventory->Element->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="start_datetime" class="form-label">Fecha y Hora de Inicio</label>
                                    <input type="datetime-local" class="form-control" id="start_datetime"
                                        name="start_datetime" placeholder="Fecha Inicio">
                                </div>
                                <div class="mb-3">
                                    <label for="end_datetime" class="form-label">Fecha y Hora de Fin</label>
                                    <input type="datetime-local" class="form-control" id="end_datetime"
                                        name="end_datetime" placeholder="Fecha Inicio">
                                </div>
                                <div class="mb-3">
                                    <label for="state">Estado</label>
                                    <select class="form-control" id="state" name="state">
                                        <option value="">Seleccione estado</option>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div><br>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $title }}</div>

                        <div class="card-body">
                            <table id="datatable" class="table table-sm table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Personal ID</th>
                                        <th>Inventario ID</th>
                                        <th>Fecha | Hora Inicio</th>
                                        <th>Fecha | Hora Devolución</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ $loan->id }}</td>
                                            <td>
                                                @foreach ($staff_senaempresas as $staff_senaempresa)
                                                    @if ($staff_senaempresa->id == $loan->staff_senaempresa_id)
                                                        {{ $loan->staff_senaempresa_id }}
                                                        {{ $staff_senaempresa->Apprentice->Person->first_name }}
                                                        {{ $staff_senaempresa->Apprentice->Person->first_last_name }}
                                                    @endif
                                                @endforeach
                                            </td>inventories
                                            <td>
                                                @foreach ($inventories as $inventory)
                                                    @if ($inventory->id == $loan->inventory_id)
                                                        {{ $loan->inventory_id }} {{ $inventory->Element->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $loan->start_datetime }}</td>
                                            <td>{{ $loan->end_datetime }}</td>
                                            <td>{{ $loan->state }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('content')
        @show

    </div>

    <!-- Main Footer -->
    @include('senaempresa::layouts.structure.footer')

    @include('senaempresa::layouts.structure.scripts')

    <!--scripts utilizados para procesos-->
    @section('scripts')
    @show

    @section('dataTables')
    @show

</body>

</html>
