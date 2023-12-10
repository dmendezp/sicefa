@extends('senaempresa::layouts.master')
@section('stylesheet')
    <style>
        /* Estilo del fondo oscuro detrás del modal */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* Estilo del modal */
        .modal-content {
            background-color: #fff;
            /* Cambia el color de fondo del modal */
            border-radius: 10px;
            /* Agrega bordes redondeados al modal */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.296);
            /* Agrega una sombra al modal */
        }

        /* Estilo del encabezado del modal */
        .modal-header {
            background-color: #2ea29c;
            /* Cambia el color de fondo del encabezado */
            color: #fff;
            /* Cambia el color del texto del encabezado */
            border-bottom: none;
            /* Quita el borde inferior del encabezado */
        }

        /* Estilo del cuerpo del modal */
        .modal-body {
            padding: 20px;
            /* Añade espacio interno al cuerpo del modal */
        }

        /* Estilo del título del modal */
        .modal-title {
            color: #fff;
            /* Cambia el color del título del modal */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body"><a
                            href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.generate.inventory.pdf') }}"
                            class="btn btn-primary">Generate PDF</a>
                        <table id="inventory" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Id') }}</th>
                                    <th>Person ID</th>
                                    <th>productive_unit_warehouse_id</th>
                                    <th>element_id</th>
                                    <th>destination</th>
                                    <th>description</th>
                                    <th>price</th>
                                    <th>amount</th>
                                    <th>stock</th>
                                    <th>production_date</th>
                                    <th>lot_number</th>
                                    <th>expiration_date</th>
                                    <th>state</th>
                                    <th>mark</th>
                                    <th>inventory_code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ $inventory->person_id }}</td>
                                        <td>{{ $inventory->productive_unit_warehouse_id }}</td>
                                        <td>{{ $inventory->element->name }}</td>
                                        <td>{{ $inventory->destination }}</td>
                                        <td>{{ $inventory->description }}</td>
                                        <td>{{ $inventory->price }}</td>
                                        <td>{{ $inventory->amount }}</td>
                                        <td>{{ $inventory->stock }}</td>
                                        <td>{{ $inventory->production_date }}</td>
                                        <td>{{ $inventory->lot_number }}</td>
                                        <td>{{ $inventory->expiration_date }}</td>
                                        <td>{{ $inventory->state }}</td>
                                        <td>{{ $inventory->mark }}</td>
                                        <td>{{ $inventory->inventory_code }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
