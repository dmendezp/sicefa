@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: flex-start; /* Alinea el contenido a la izquierda */
        align-items: center;
        min-height: 100vh;
        padding-left: 10%; /* Ajusta este valor para mover más hacia la derecha */
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
        margin-bottom: 2rem; /* Aumenta el espacio entre los campos */
    }
    .form-control {
        border-radius: 8px;
        padding: 1rem 1.5rem; /* Aumenta el tamaño del padding */
        font-size: 1.1rem; /* Aumenta el tamaño del texto */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff; /* Color original */
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3); /* Aumenta la sombra */
    }
    .floating-label {
        position: absolute;
        top: 50%;
        left: 1.5rem; /* Ajusta el espacio del label */
        transform: translateY(-50%);
        color: #6c757d;
        transition: all 0.2s ease;
        pointer-events: none;
        font-size: 1rem; /* Aumenta el tamaño del label */
    }
    .form-control:not(:placeholder-shown) + .floating-label,
    .form-control:focus + .floating-label {
        top: 0;
        font-size: 0.9rem;
        color: #007bff; /* Color original */
        background: white;
        padding: 0 0.3rem;
    }
    .invalid-feedback {
        font-size: 0.9rem;
        color: #dc3545; /* Color original */
    }
    .btn-primary {
        background: #007bff; /* Color original */
        border: none;
        padding: 1rem 2.5rem; /* Aumenta el tamaño del botón */
        font-size: 1.1rem; /* Aumenta el tamaño del texto del botón */
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background: #0056b3; /* Color original */
        transform: translateY(-2px);
    }
    .btn-secondary {
        border-radius: 8px;
        padding: 1rem 2.5rem; /* Aumenta el tamaño del botón */
        font-size: 1.1rem; /* Aumenta el tamaño del texto del botón */
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
            margin-bottom: 1.5rem;
        }
    }
    
</style>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10"> <!-- Aumenta el ancho del contenedor -->
            <div class="card form-card animate__animated animate__fadeIn">
                <div class="card-header text-center">
                    Crear Ciclo Reproductivo
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sipork.admin.sipork.ciclos_reproductivos.store') }}">
                        @csrf
                        <div class="row">
                            <!-- Sow -->
                            <div class="col-md-6 form-group">
                                <select name="sow_id" id="sow_id" class="form-control @error('sow_id') is-invalid @enderror">
                                    <option value="" disabled selected>Seleccionar Cerda</option>
                                    @foreach ($pigs as $pig)
                                        <option value="{{ $pig->id_pig }}" {{ old('sow_id') == $pig->id_pig ? 'selected' : '' }}>
                                            {{ $pig->id_pig }} ({{ $pig->breed }})
                                        </option>
                                    @endforeach
                                </select>
                                <label for="sow_id" class="floating-label">Cerda</label>
                                <span class="form-icon"><i class="fas fa-piggy-bank"></i></span>
                                @error('sow_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Service Date -->
                            <div class="col-md-6 form-group">
                                <input type="date" name="service_date" id="service_date" class="form-control @error('service_date') is-invalid @enderror" value="{{ old('service_date') }}" placeholder=" ">
                                <label for="service_date" class="floating-label">Fecha de Servicio</label>
                                <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                @error('service_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Birth Date -->
                            <div class="col-md-6 form-group">
                                <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required placeholder=" ">
                                <label for="birth_date" class="floating-label">Fecha de Nacimiento </label>
                                <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                @error('birth_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Live Piglets -->
                            <div class="col-md-6 form-group">
                                <input type="number" name="live_piglets" id="live_piglets" class="form-control @error('live_piglets') is-invalid @enderror" value="{{ old('live_piglets') }}" placeholder=" ">
                                <label for="live_piglets" class="floating-label">Lechones Vivos</label>
                                <span class="form-icon"><i class="fas fa-paw"></i></span>
                                @error('live_piglets')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Dead Piglets -->
                            <div class="col-md-6 form-group">
                                <input type="number" name="dead_piglets" id="dead_piglets" class="form-control @error('dead_piglets') is-invalid @enderror" value="{{ old('dead_piglets') }}" placeholder=" ">
                                <label for="dead_piglets" class="floating-label">Lechones Muertos</label>
                                <span class="form-icon"><i class="fas fa-heart-broken"></i></span>
                                @error('dead_piglets')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Lactation End Date -->
                            <div class="col-md-6 form-group">
                                <input type="date" name="lactation_end_date" id="lactation_end_date" class="form-control @error('lactation_end_date') is-invalid @enderror" value="{{ old('lactation_end_date') }}" required placeholder=" ">
                                <label for="lactation_end_date" class="floating-label">Fecha de Fin de Lactancia</label>
                                <span class="form-icon"><i class="fas fa-calendar-alt"></i></span>
                                @error('lactation_end_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
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