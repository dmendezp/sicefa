@extends('ptventa::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active">Elementos</li>
@endsection

@section('content')
<div class="card card-primary card-outline col-12 mx-auto">
    <div class="table table-responsive table-sm px-3 py-1">
        <table class="table table-striped" id="table-element">
            {{-- The id is the one coming from the javascript function of the datatatble located in the view scripts file --}}
            <thead class="table-dark mt-0 pt-0">
                <tr>
                    <th class="text-center">#</th>
                    <th>Nombre</th>
                    <th class="text-center">Unidad de medida</th>
                    <th class="text-center">Tipo de compra</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody  style="font-size: 14px">
                @foreach ($element as $e)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $e->name }}</td>
                        <td>{{ $e->measurement_unit->name }}</td>
                        <td>{{ $e->kind_of_purchase->name }}</td>
                        <td>{{ $e->category->name }}</td>
                        <td>
                            <a href="{{ route('ptventa.admin.element.edit', $e) }}" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip" data-placement="top" title="Actualizar empleado">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@endsection