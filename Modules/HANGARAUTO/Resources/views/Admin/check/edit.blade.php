@extends('hangarauto::layouts.master')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header">
                    <h4>Editar Chequeo</h4>
                </div><br>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.update', $checkup->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="driver">Conductor:</label>
                                <select name="driver" id="driver" class="form-control" required>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ $driver->id == $checkup->driver_id ? 'selected' : '' }}>{{ $driver->person->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vehicle">Vehiculo:</label>
                                <select name="vehicle" id="vehicle" class="form-control" required>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ $vehicle->id == $checkup->vehicle_id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Fecha:</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $checkup->date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="initial_kilometer">Kilometro Inicial:</label>
                                <input type="number" name="initial_kilometer" id="initial_kilometer" class="form-control" value="{{ $checkup->initial_kilometer }}" required>
                            </div>
                            <div class="form-group">
                                <label for="final_kilometer">Kilometro Final:</label>
                                <input type="number" name="final_kilometer" id="final_kilometer" class="form-control" value="{{ $checkup->final_kilometer }}" required>
                            </div>
                            <div class="form-group">
                                <label for="initial_hour">Hora Inicial:</label>
                                <input type="time" name="initial_hour" id="initial_hour" class="form-control" value="{{ $checkup->initial_hour }}" required>
                            </div>
                            <div class="form-group">
                                <label for="final_hour">Hora Final:</label>
                                <input type="time" name="final_hour" id="final_hour" class="form-control" value="{{ $checkup->final_hour }}" required>
                            </div>
                            <hr>
                            <h5>Elementos a Inspeccionar:</h5>
                            @foreach($checklist_items as $index => $item)
                                <div class="form-group">
                                    <label for="item_{{ $index }}">{{ $item }}</label>
                                    <input type="hidden" name="checklist_items[]" value="{{ $item }}">
                                    
                                    <div class="form-check">
                                        <input type="radio" name="observations[{{ $index }}][complete]" value="yes" class="form-check-input" id="item_yes_{{ $index }}" {{ $checkup->check_lists->where('inspection', $item)->first()->complete == 'Si' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="item_yes_{{ $index }}">Si</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="observations[{{ $index }}][complete]" value="no" class="form-check-input" id="item_no_{{ $index }}" {{ $checkup->check_lists->where('inspection', $item)->first()->complete == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="item_no_{{ $index }}">No</label>
                                    </div>
                                    
                                    <input type="text" name="observations[{{ $index }}][observation]" class="form-control" value="{{ $checkup->check_lists->where('inspection', $item)->first()->observation }}" placeholder="Observation">
                                </div>
                            @endforeach
                            
                            <hr>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
