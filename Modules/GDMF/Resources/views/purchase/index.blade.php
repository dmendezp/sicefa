@extends('gdmf::layouts.master')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4>Importar Compra Masiva (Excel)</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('gdmf.academic_coordination.purchase.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="file">Archivo Excel (.xlsx):</label>
                    <input type="file" name="file" class="form-control" required accept=".xlsx,.xls">
                </div>
                <button type="submit" class="btn btn-success">Importar</button>
            </form>
        </div>
    </div>
</div>
@endsection
