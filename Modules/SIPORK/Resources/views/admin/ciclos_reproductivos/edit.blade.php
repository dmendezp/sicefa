@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center rounded-top">
                        <h5 class="font-weight-bold m-0">
                            <i class="fas fa-edit"></i> Edit Reproductive Cycle
                        </h5>
                    </div>
                <div class="card-body">
                <form action="{{ route('sipork.admin.sipork.ciclos_reproductivos.update', $reproductiveCycle->id_cycle) }}" method="POST">
                @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="sow_id">Sow</label>
                            <select name="sow_id" id="sow_id" class="form-control @error('sow_id') is-invalid @enderror">
                                <option value="">Select Sow</option>
                                @foreach ($pigs as $pig)
                                    <option value="{{ $pig->id_pig }}" {{ $reproductiveCycle->sow_id == $pig->id_pig ? 'selected' : '' }}>
                                        {{ $pig->id_pig }} ({{ $pig->breed }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sow_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="service_date">Service Date</label>
                            <input type="date" name="service_date" id="service_date" class="form-control @error('service_date') is-invalid @enderror" value="{{ $reproductiveCycle->service_date }}">
                            @error('service_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ $reproductiveCycle->birth_date }}">
                            @error('birth_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="live_piglets">Live Piglets</label>
                            <input type="number" name="live_piglets" id="live_piglets" class="form-control @error('live_piglets') is-invalid @enderror" value="{{ $reproductiveCycle->live_piglets }}">
                            @error('live_piglets')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dead_piglets">Dead Piglets</label>
                            <input type="number" name="dead_piglets" id="dead_piglets" class="form-control @error('dead_piglets') is-invalid @enderror" value="{{ $reproductiveCycle->dead_piglets }}">
                            @error('dead_piglets')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lactation_end_date">Lactation End Date</label>
                            <input type="date" name="lactation_end_date" id="lactation_end_date" class="form-control @error('lactation_end_date') is-invalid @enderror" value="{{ $reproductiveCycle->lactation_end_date }}">
                            @error('lactation_end_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection