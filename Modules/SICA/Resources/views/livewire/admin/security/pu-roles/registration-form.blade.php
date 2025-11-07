<div>
    <div class="modal-header">
        <h5 class="modal-title">Registro de asociación de unidad productiva y rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form wire:submit.prevent="storePuRole" id="form-registration-pu_role">
        <div class="modal-body pb-1">
            @if($message_pu_role)
                <div class="alert alert-{{ $color_message_pu_role }} message_pu_role">
                    {{ $message_pu_role }}
                </div>
            @endif
            <div class="form-group">
                <label>Aplicación:</label>
                <select name="app_id" class="form-control" wire:model="app_id" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($apps as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
                @error('app_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Rol:</label>
                <select name="role_id" class="form-control" wire:model="role_id" @if(empty($roles)) disabled @endif required>
                    <option value="">-- Seleccione --</option>
                    @if(!empty($roles))
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Finca:</label>
                <select name="farm_id" class="form-control" wire:model="farm_id" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                </select>
                @error('farm_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Unidad productiva:</label>
                <select name="productive_unit_id" class="form-control" wire:model="productive_unit_id" @if(empty($productive_units)) disabled @endif required>
                    <option value="">-- Seleccione --</option>
                    @if(!empty($productive_units))
                        @foreach ($productive_units as $pu)
                            <option value="{{ $pu->id }}">{{ $pu->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('productive_unit_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="modal-footer py-1">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="storePuRole">Registrar</button>
        </div>
    </form>
</div>

@section('sripts-register-pu_role')
    <script>
        window.livewire.on('close_alert_message_pu_role', function () {
            var alertElement = document.querySelector('.message_pu_role');
            if (alertElement) {
                alertElement.style.display = 'block';
                setTimeout(function () {
                    alertElement.style.display = 'none';
                }, 5000); // Ocultar después de 5 segundos
            }
        });
    </script>
@endsection
