@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Caja</li>
@endpush

@section('content')
    <div class="container">
        <h1>Arqueo de Caja</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('arqueo.store') }}">
            @csrf

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="saldo_inicial">Saldo Inicial</label>
                <input type="number" id="saldo_inicial" name="saldo_inicial" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="saldo_final">Saldo Final</label>
                <input type="number" id="saldo_final" name="saldo_final" class="form-control" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
