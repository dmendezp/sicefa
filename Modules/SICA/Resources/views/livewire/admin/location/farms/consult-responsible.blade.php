<div>
    <div class="form-group">
        <label>Persona responsable:</label>
        <div class="row">
            <div class="col-4">
                {!! Form::number('responsible_document_number', null, [
                    'class'=>'form-control',
                    'placeholder'=>'# Identificación',
                    'wire:model.defer' => 'responsible_document_number',
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => 'consultResponsible'
                ]) !!}
                {!! Form::hidden('responsible_id', null, [
                    'wire:model' => 'responsible_id'
                ]) !!}
            </div>
            <div class="col-auto p-0">
                <button type="button" class="btn btn-sm btn-success h-100" wire:click="consultResponsible" wire:loading.attr="disabled" wire:target="consultResponsible" data-toggle='tooltip' data-placement="top" title="Consultar persona">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="col ml-2">
                {!! Form::text('responsible_full_name', null, [
                    'class'=>'form-control',
                    'placeholder'=>'Nombre completo del líder',
                    'readonly',
                    'wire:model' => 'responsible_full_name'
                ]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>País:</label>
        <select class="form-control" name="country_id" wire:model="country_id" required>
            <option value="">-- Seleccione</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Departamento:</label>
        <select class="form-control" name="department_id" wire:model="department_id" @if(empty($departments)) disabled @endif required>
            <option value="">-- Seleccione</option>
            @if(!empty($departments))
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label>Municipio:</label>
        <select class="form-control" name="municipality_id" wire:model="municipality_id" @if(empty($municipalities)) disabled @endif required>
            <option value="">-- Seleccione</option>
            @if(!empty($municipalities))
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
