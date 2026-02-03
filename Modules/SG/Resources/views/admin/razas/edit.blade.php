@extends('sg::layouts.master')

@section('content')
<br><br><br>

<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="font-weight-bold text-dark">
            🧬 Editar Raza
        </h3>
        <p class="text-muted">
            {{ $breed->name }}
        </p>
    </div>

    {{-- CARD --}}
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('sg.admin.sg.razas.update', $breed) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NOMBRE --}}
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Nombre de la Raza <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $breed->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Ej: Holstein, Brahman, Jersey">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Descripción
                            </label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Características principales de la raza">{{ old('description', $breed->description) }}</textarea>
                        </div>

                        <hr>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sg.admin.sg.razas.index') }}"
                               class="btn btn-outline-secondary">
                                ← Volver
                            </a>

                            <button type="submit"
                                    class="btn btn-success px-4">
                                💾 Actualizar Raza
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
