@extends('sipork::layouts.master')

@section('content')
<br><br><br>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-center">
                <h1 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-edit"></i> Editar Cerdo 
                    <small class="text-muted">#{{ $pig->id_pig }}</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light p-2 rounded shadow-sm float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-primary font-weight-bold">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('sipork.admin.sipork.admin.index') }}" class="text-primary font-weight-bold">
                                <i class="fas fa-piggy-bank"></i> Pigs
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">
                            <i class="fas fa-edit"></i> Edit Pig
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center rounded-top">
                        <h5 class="font-weight-bold m-0">
                            <i class="fas fa-edit"></i> Editar Detalles del Cerdo
                        </h5>
                    </div>
                    <form action="{{ route('sipork.admin.sipork.admin.update', $pig->id_pig) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Fecha de nacimiento -->
                                <div class="col-md-6 form-group">
                                    <label for="birth_date" class="font-weight-bold">Fecha de nacimiento <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $pig->birth_date) }}" required>
                                    </div>
                                    @error('birth_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Peso inicial -->
                                <div class="col-md-6 form-group">
                                    <label for="initial_weight" class="font-weight-bold">Peso inicial (kg) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-weight"></i></span>
                                        </div>
                                        <input type="number" step="0.01" name="initial_weight" id="initial_weight" class="form-control @error('initial_weight') is-invalid @enderror" value="{{ old('initial_weight', $pig->initial_weight) }}" required>
                                    </div>
                                    @error('initial_weight')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Género -->
                                <div class="col-md-6 form-group">
                                    <label for="gender" class="font-weight-bold">Género <span class="text-danger">*</span></label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccionar género</option>
                                        <option value="M" {{ old('gender', $pig->gender) == 'M' ? 'selected' : '' }}>Macho</option>
                                        <option value="F" {{ old('gender', $pig->gender) == 'F' ? 'selected' : '' }}>Hembra</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Raza -->
                                <div class="col-md-6 form-group">
                                    <label for="breed" class="font-weight-bold">Raza <span class="text-danger">*</span></label>
                                    <select name="breed" id="breed" class="form-control @error('breed') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccionar raza</option>
                                        <option value="Pietrain" {{ old('breed', $pig->breed) == 'Pietrain' ? 'selected' : '' }}>Pietrain</option>
                                        <option value="Duroc" {{ old('breed', $pig->breed) == 'Duroc' ? 'selected' : '' }}>Duroc</option>
                                        <option value="Landrace" {{ old('breed', $pig->breed) == 'Landrace' ? 'selected' : '' }}>Landrace</option>
                                        <option value="Hampshire" {{ old('breed', $pig->breed) == 'Hampshire' ? 'selected' : '' }}>Hampshire</option>
                                        <option value="Large-White" {{ old('breed', $pig->breed) == 'Large-White' ? 'selected' : '' }}>Large White</option>
                                    </select>
                                    @error('breed')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Estado -->
                                <div class="col-md-6 form-group">
                                    <label for="status" class="font-weight-bold">Estado <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="" disabled>Seleccionar estado</option>
                                        <option value="Active" {{ old('status', $pig->status) == 'Active' ? 'selected' : '' }}>Activo</option>
                                        <option value="Weaned" {{ old('status', $pig->status) == 'Weaned' ? 'selected' : '' }}>Destetado</option>
                                        <option value="Sold" {{ old('status', $pig->status) == 'Sold' ? 'selected' : '' }}>Vendido</option>
                                        <option value="Deceased" {{ old('status', $pig->status) == 'Deceased' ? 'selected' : '' }}>Fallecido</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fecha de destete -->
                                <div class="col-md-6 form-group">
                                    <label for="weaning_date" class="font-weight-bold">Fecha de destete (Opcional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="weaning_date" id="weaning_date" class="form-control @error('weaning_date') is-invalid @enderror" value="{{ old('weaning_date', $pig->weaning_date) }}">
                                    </div>
                                    @error('weaning_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fecha de venta -->
                                <div class="col-md-6 form-group">
                                    <label for="sale_date" class="font-weight-bold">Fecha de venta (Opcional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="sale_date" id="sale_date" class="form-control @error('sale_date') is-invalid @enderror" value="{{ old('sale_date', $pig->sale_date) }}">
                                    </div>
                                    @error('sale_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light d-flex justify-content-end">
                            <a href="{{ route('sipork.admin.sipork.admin.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar cerdo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection