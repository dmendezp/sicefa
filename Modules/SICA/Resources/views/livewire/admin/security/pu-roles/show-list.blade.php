<div>
    <div class="row mb-0">
        <div class="col-md">
            <div class="form-group row my-0">
                <label class="col-sm-auto col-form-label">Aplicación:</label>
                <div class="col-sm-auto">
                    <select name="app_id" class="form-control" wire:model="app_id" required>
                        <option value="">-- Seleccione --</option>
                        @foreach ($apps as $app)
                            <option value="{{ $app->id }}"><i class="fas fa-car"></i>{{ $app->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm"></div>
            </div>
        </div>
        <div class="col-md-auto">
            <!-- Botón para lanzar el modal de registro de asociación de rol y unidad productiva -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pu_role-registration-modal">
                <i class="fas fa-plus"></i> Registrar asociación de rol y unidad productiva
            </button>
        </div>
    </div>
    <div class="text-center">
        <div wire:loading>
            <div class="spinner-border text-success text-center" role="status">
            </div><br>
            <strong>Cargando...</strong>
        </div>
    </div>
    <div wire:loading.remove>
        @empty($app_id)
            <div class="text-center text-danger m-3">
                <strong>Selecciona una aplicación para consultar asociación de roles y unidades productivas.</strong>
            </div>
        @else
            <div class="text-center">
                <h1 style="color: {{ $app_selected->color }}"><i class="fas {{ $app_selected->icon }} mr-2"></i>{{ $app_selected->name }}</h1>
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Unidad productiva</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($app_selected->roles) == 0)
                        <tr>
                            <td colspan="3" class="text-center text-danger">
                                <strong>No se encontraron roles registradas para la aplicación.</strong>
                            </td>
                        </tr>
                    @else
                        @php
                            $previous_role_id = null;
                            $records_found = false;
                        @endphp
                        @foreach ($app_selected->roles as $r)
                            @if (!$r->productive_units->count() == 0)
                                @php
                                    $records_found = true;
                                @endphp
                                @foreach ($r->productive_units->sortBy('name') as $pu)
                                    @if ($previous_role_id !== $r->id)
                                        @php
                                            $previous_role_id = $r->id;
                                        @endphp
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle" rowspan="{{ $r->productive_units->count() }}">
                                                {{ $r->name }}
                                            </th>
                                    @endif
                                            <td class="text-center">{{ $pu->name }}</td>
                                            <td class="text-center">
                                                <a href="#" onclick="confirmDelete({{ $r->id }}, {{ $pu->id }}, '{{ $r->name }}', '{{ $pu->name }}')" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Validar si se han encrontrado asociaciones de unidades productivas --}}
                        @if (!$records_found)
                            <tr>
                                <td colspan="3" class="text-center text-danger">
                                    <strong>No se encontró ninguna asociación de unidad productiva y rol registrada.</strong>
                                </td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        @endempty
    </div>
</div>
