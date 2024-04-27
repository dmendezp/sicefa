@extends('hangarauto::layouts.master')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header">
                    <h4>Registrar Nuevo Chequeo</h4>
                </div><br>
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="driver">Conductor:</label>
                                <select name="driver" id="driver" class="form-control" required>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->person->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vehicle">Vehiculo:</label>
                                <select name="vehicle" id="vehicle" class="form-control" required>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Fecha:</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="initial_kilometer">Kilometro Inicial:</label>
                                <input type="number" name="initial_kilometer" id="initial_kilometer" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="final_kilometer">Kilometro Final:</label>
                                <input type="number" name="final_kilometer" id="final_kilometer" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="initial_hour">Hora Inicial:</label>
                                <input type="time" name="initial_hour" id="initial_hour" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="final_hour">Hora Final:</label>
                                <input type="time" name="final_hour" id="final_hour" class="form-control" required>
                            </div>
                            <hr>
                            <h5>Elementos a Inspeccionar:</h5>
                            @foreach($checklist_items as $index => $item)
                                <div class="form-group">
                                    <label for="item_{{ $index }}">{{ $item }}</label>
                                    <input type="hidden" name="checklist_items[]" value="{{ $item }}">

                                    <div class="form-check">
                                        <input type="radio" name="observations[{{ $index }}][complete]" value="yes" class="form-check-input" id="item_yes_{{ $index }}">
                                        <label class="form-check-label" for="item_yes_{{ $index }}">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="observations[{{ $index }}][complete]" value="no" class="form-check-input" id="item_no_{{ $index }}">
                                        <label class="form-check-label" for="item_no_{{ $index }}">No</label>
                                    </div>

                                    <input type="text" name="observations[{{ $index }}][observation]" class="form-control" placeholder="Observation">
                                </div>
                            @endforeach
                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateChecklist() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var allChecked = true;
            
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });
    
            if (!allChecked) {
                alert("Por favor, marca todas las casillas de verificación.");
            }
    
            return allChecked;
        }
    </script>
@endsection
