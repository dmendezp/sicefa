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
            <!-- Botón para lanzar el modal de registro de responsabilidad -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsibility-registration-modal">
                <i class="fas fa-plus"></i> Registrar reponsabilidad
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
            <div class="text-center text-danger">
                <strong>Selecciona una aplicación para consultar responsabilidades.</strong>
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
                        <th class="text-center">Actividad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($responsibilities) == 0)
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                <strong>No se encontraron responsabilidades registradas para la aplicación.</strong>
                            </td>
                        </tr>
                    @else
                        @php
                            $previous_role_id = null;
                        @endphp
                        @foreach ($responsibilities as $r)
                            @if ($previous_role_id !== $r->role_id)
                                @php
                                    $previous_role_id = $r->role_id;
                                    $previous_productive_unit_id = null;
                                @endphp
                                <tr>
                                    <th class="text-center" style="vertical-align: middle" rowspan="{{ $responsibilities->where('role_id', $r->role_id)->count() }}">
                                        {{ $r->role->name }}
                                    </th>
                            @endif

                            @if ($previous_productive_unit_id !== $r->activity->productive_unit_id)
                                @php
                                    $previous_productive_unit_id = $r->activity->productive_unit_id;
                                @endphp
                                <td class="text-center" style="vertical-align: middle" rowspan="{{ $responsibilities->where('role_id', $r->role_id)->where('activity.productive_unit_id', $r->activity->productive_unit_id)->count() }}">
                                    {{ $r->activity->productive_unit->name }}
                                </td>
                            @endif

                                <td class="text-center">{{ $r->activity->name }}</td>
                                <td class="text-center">
                                    <a href="#" onclick="confirmDelete({{ $r->id }}, '{{ $r->role->name }}', '{{ $r->activity->name }}')" data-toggle='tooltip' data-placement="top" title="Eliminar responsabilidad">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endempty
    </div>
</div>
