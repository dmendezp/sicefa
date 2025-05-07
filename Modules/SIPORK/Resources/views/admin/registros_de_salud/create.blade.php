@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear registro de salud</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                            <label for="pig_id">Cerdo</label>
                            <select name="pig_id" id="pig_id" class="form-control @error('pig_id') is-invalid @enderror">
                                <option value="">Seleccionar cerdo</option>
                                @foreach ($pigs as $pig)
                                    <option value="{{ $pig->id_pig }}" {{ old('pig_id') == $pig->id_pig ? 'selected' : '' }}>
                                        {{ $pig->id_pig }} ({{ $pig->breed }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pig_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="record_type">Tipo de registro</label>
                            <input type="text" name="record_type" id="record_type" class="form-control @error('record_type') is-invalid @enderror" value="{{ old('record_type') }}">
                            @error('record_type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="application_date">Fecha de aplicación</label>
                            <input type="date" name="application_date" id="application_date" class="form-control @error('application_date') is-invalid @enderror" value="{{ old('application_date') }}">
                            @error('application_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cost_id">Costo</label>
                            <select name="cost_id" id="cost_id" class="form-control @error('cost_id') is-invalid @enderror">
                                <option value="">Select Cost</option>
                                @foreach ($costs as $cost)
                                    <option value="{{ $cost->id_cost }}" {{ old('cost_id') == $cost->id_cost ? 'selected' : '' }}>
                                        {{ $cost->id_cost }} ({{ $cost->cost_type }} - {{ $cost->amount }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cost_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
