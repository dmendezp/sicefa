@extends('sipork::layouts.master')

@section('content')
<br><br><br><br>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: flex-start; /* Alinea el contenido a la izquierda */
        align-items: center;
        min-height: 100vh;
        padding-left: 14%; /* Ajusta este valor para mover más hacia la derecha */
        background-color: #f4f4f4;
    }
    .form-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .form-card .card-header {
        background: linear-gradient(90deg, #007bff, #0056b3);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 1.5rem;
        text-align: center; /* Centra el texto horizontalmente */
        display: flex;
        justify-content: center; /* Asegura que el contenido esté centrado */
        align-items: center; /* Centra verticalmente */
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
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
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
        color: #007bff;
        background: white;
        padding: 0 0.2rem;
    }
    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
    }
    .btn-primary {
        background: #007bff;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }
    .btn-secondary {
        border-radius: 8px;
        padding: 0.75rem 2rem;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-secondary:hover {
        transform: translateY(-2px);
    }
    .form-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }
        .form-card {
            box-shadow: none;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
</style>

<center>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card form-card animate__animated animate__fadeIn">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Formulario de registro de cerdos</h3>
                    </div>
                    <form action="  " method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Fecha de nacimiento -->
                                <div class="col-md-6 form-group">
                                    <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required placeholder=" ">
                                    <label for="birth_date" class="floating-label">Fecha de nacimiento <span class="text-danger">*</span></label>
                                    <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                    @error('birth_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Initial Weight -->
                                <div class="col-md-6 form-group">
                                    <input type="number" step="0.01" name="initial_weight" id="initial_weight" class="form-control @error('initial_weight') is-invalid @enderror" value="{{ old('initial_weight') }}" required placeholder=" ">
                                    <label for="initial_weight" class="floating-label">Peso inicial (kg) <span class="text-danger">*</span></label>
                                    <span class="form-icon"><i class="fas fa-weight"></i></span>
                                    @error('initial_weight')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 form-group">
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="" disabled selected>Seleccionar genero</option>
                                        <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Macho</option>
                                        <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Hembra</option>
                                    </select>
                                    <label for="gender" class="floating-label">Genero <span class="text-danger">*</span></label>
                                    <span class="form-icon"><i class="fas fa-venus-mars"></i></span>
                                    @error('gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mother ID -->
                                <div class="col-md-6 form-group">
                                    <select name="mother_id" id="mother_id" class="form-control @error('mother_id') is-invalid @enderror">
                                        <option value="">Seleccionar madre</option>
                                        @foreach($mothers as $mother)
                                            <option value="{{ $mother->id_pig }}" {{ old('mother_id') == $mother->id_pig ? 'selected' : '' }}>
                                                Pig #{{ $mother->id_pig }} (Born: {{ $mother->birth_date }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="mother_id" class="floating-label">Madre (Opcional)</label>
                                    <span class="form-icon"><i class="fas fa-piggy-bank"></i></span>
                                    @error('mother_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 form-group">
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="" disabled selected>Seleccionar estado</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Activo</option>
                                        <option value="Weaned" {{ old('status') == 'Weaned' ? 'selected' : '' }}>Decantado</option>
                                        <option value="Sold" {{ old('status') == 'Sold' ? 'selected' : '' }}>Vendido</option>
                                        <option value="Deceased" {{ old('status') == 'Deceased' ? 'selected' : '' }}>Engañados</option>
                                    </select>
                                    <label for="status" class="floating-label">Estado <span class="text-danger">*</span></label>
                                    <span class="form-icon"><i class="fas fa-info-circle"></i></span>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Weaning Date -->
                                <div class="col-md-6 form-group">
                                    <input type="date" name="weaning_date" id="weaning_date" class="form-control @error('weaning_date') is-invalid @enderror" value="{{ old('weaning_date') }}" placeholder=" ">
                                    <label for="weaning_date" class="floating-label">Fecha de destete (Opcional)</label>
                                    <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                    @error('weaning_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Sale Date -->
                                <div class="col-md-6 form-group">
                                    <input type="date" name="sale_date" id="sale_date" class="form-control @error('sale_date') is-invalid @enderror" value="{{ old('sale_date') }}" placeholder=" ">
                                    <label for="sale_date" class="floating-label">Fecha de venta (Opcional)</label>
                                    <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                    @error('sale_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <a href="" class="btn btn-secondary mr-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar cerdo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</center>

@section('scripts')
<script>
    // Ensure floating labels work for pre-filled selects
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