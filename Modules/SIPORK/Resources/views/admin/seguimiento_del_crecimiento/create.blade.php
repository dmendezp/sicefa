@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<style>
    .form-card {
        background: #fefae0; /* Light beige, farm-inspired */
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #588157; /* Green border for farm theme */
        transition: transform 0.3s ease;
    }
    .form-card:hover {
        transform: translateY(-5px);
    }
    .form-card .card-header {
        background: linear-gradient(90deg, #3a5a40, #588157); /* Earthy green gradient */
        color: #fff;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
        border-color: #588157;
        box-shadow: 0 0 8px rgba(88, 129, 87, 0.2);
    }
    .floating-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        color: #6c757d;
        transition: all 0.2s ease;
        pointer-events: none;
    }
    .form-control:not(:placeholder-shown) + .floating-label,
    .form-control:focus + .floating-label {
        top: 0;
        font-size: 0.85rem;
        color: #3a5a40;
        background: #fefae0;
        padding: 0 0.2rem;
    }
    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
    }
    .btn-primary {
        background: #588157;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background: #3a5a40;
        transform: translateY(-2px);
    }
    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    .form-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    @media (max-width: 768px) {
        .form-card {
            box-shadow: none;
            border: none;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
</style>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card form-card animate__animated animate__fadeIn">
                <div class="card-header text-center">
                    Crear Seguimiento del Crecimiento
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <!-- Pig -->
                        <div class="form-group">
                            <select name="pig_id" id="pig_id" class="form-control @error('pig_id') is-invalid @enderror">
                                <option value="" disabled selected>Seleccionar Cerdo</option>
                                @foreach ($pigs as $pig)
                                    <option value="{{ $pig->id_pig }}" {{ old('pig_id') == $pig->id_pig ? 'selected' : '' }}>
                                        {{ $pig->id_pig }} ({{ $pig->breed }})
                                    </option>
                                @endforeach
                            </select>
                            <label for="pig_id" class="floating-label">Cerdo</label>
                            <span class="form-icon"><i class="fas fa-piggy-bank"></i></span>
                            @error('pig_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Measurement Date -->
                        <div class="form-group">
                            <input type="date" name="measurement_date" id="measurement_date" class="form-control @error('measurement_date') is-invalid @enderror" value="{{ old('measurement_date') }}" placeholder=" ">
                            <label for="measurement_date" class="floating-label">Fecha de Medición</label>
                            <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                            @error('measurement_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div class="form-group">
                            <input type="number" step="0.01" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" placeholder=" ">
                            <label for="weight" class="floating-label">Peso (kg)</label>
                            <span class="form-icon"><i class="fas fa-weight"></i></span>
                            @error('weight')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Observations -->
                        <div class="form-group">
                            <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror" placeholder=" ">{{ old('observations') }}</textarea>
                            <label for="observations" class="floating-label">Observaciones</label>
                            <span class="form-icon"><i class="fas fa-sticky-note"></i></span>
                            @error('observations')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="" class="btn btn-secondary ml-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.querySelectorAll('select').forEach(select => {
        if (select.value) {
            select.nextElementSibling.classList.add('active');
        }
        select.addEventListener('change', () => {
            if (select.value) {
                select.nextElementSibling.classList.add('active');
            } else {
                select.nextElementSibling.classList.remove('active');
            }
        });
    });
</script>
@endsection