@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.cash.index') }}" class="text-decoration-none">Caja</a>
    <li class="breadcrumb-item active">Arqueo Caja</li>
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1>Arqueo de Caja</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('ptventa.cashCount.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="date">Fecha de Apertura</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="initial_balance">Saldo Inicial</label>
                            <input type="number" id="initial_balance" name="initial_balance" class="form-control" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="final_balance">Saldo Final</label>
                            <input type="number" id="final_balance" name="final_balance" class="form-control" step="0.01" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Encargado</th>
                                <th scope="col">Fecha de apertura</th>
                                <th scope="col">Saldo Inicial</th>
                                <th scope="col">Saldo Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>25-05-2023</td>
                                <td>300000</td>
                                <td>300000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
