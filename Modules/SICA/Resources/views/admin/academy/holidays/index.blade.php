@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Días festivos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                @isset($holiday)
                                    <form action="{{ route('sica.admin.academy.holidays.store', $holiday) }}" method="post">
                                @else
                                    <form action="{{ route('sica.admin.academy.holidays.store') }}" method="post">
                                @endisset
                                    @csrf
                                    <div class="form-group">
                                        <label>Fecha:</label>
                                        {!! Form::date('date', old('date') ? old('date') : (isset($holiday) ? $holiday->date : ''), ['class'=>'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Asunto:</label>
                                        {!! Form::text('issue', old('issue') ? old('issue') : (isset($holiday) ? $holiday->issue : ''), ['class'=>'form-control', 'required']) !!}
                                    </div>
                                    <div class="text-center">
                                        @isset ($holiday)
                                            <a href="{{ route('sica.admin.academy.holidays.index') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        @else
                                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        @endisset
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="holidays_table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Fecha</th>
                                                <th>Asunto</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($holidays as $h)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $h->date }}</td>
                                                    <td>{{ $h->issue }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('sica.admin.academy.holidays.edit', $h) }}" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar día festivo">
                                                            <i class="fas fa-edit text-success"></i>
                                                        </a>
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar el día festivo {{ $h->date }} con asunto: {{ $h->issue }}?')) { document.getElementById('delete-form-holiday{{ $h->id }}').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar día festivo">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-holiday{{ $h->id }}" action="{{ route('sica.admin.academy.holidays.destroy', $h) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#holidays_table').DataTable({});
        });
    </script>
@endsection
