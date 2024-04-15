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
                            class="btn btn-primary">{{ trans('senaempresa::menu.Generate PDF') }}</a>
                        <table id="inventory" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('senaempresa::menu.Responsible') }}</th>
                                    <th>{{ trans('senaempresa::menu.Element') }}</th>
                                    <th>{{ trans('senaempresa::menu.Destination') }}</th>
                                    <th>{{ trans('senaempresa::menu.Price') }}</th>
                                    <th>{{ trans('senaempresa::menu.Amount') }}</th>
                                    <th>{{ trans('senaempresa::menu.Stock') }}</th>
                                    <th>{{ trans('senaempresa::menu.State') }}</th>
                                    <th>{{ trans('senaempresa::menu.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventory->person->full_name }}</td>
                                        <td>{{ $inventory->element->name }}</td>
                                        <td>{{ $inventory->destination }}</td>
                                        <td>{{ $inventory->price }}</td>
                                        <td>{{ $inventory->amount }}</td>
                                        <td>{{ $inventory->stock }}</td>
                                        <td>{{ $inventory->state }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#detailsModal{{ $inventory->id }}">
                                                {{ trans('senaempresa::menu.Details') }}
                                            </button>
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
    @foreach ($inventories as $inventory)
    <!-- Modal for details -->
    <div class="modal fade" id="detailsModal{{ $inventory->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">{{ trans('senaempresa::menu.Inventory Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ trans('senaempresa::menu.Production unit') }}:</strong> {{ $inventory->productive_unit_warehouse->productive_unit->name }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Warehouse') }}:</strong> {{ $inventory->productive_unit_warehouse->warehouse->name }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Description') }}:</strong> {{ $inventory->description }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Production date') }}:</strong> {{ $inventory->production_date }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Lot number') }}:</strong> {{ $inventory->lot_number }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Expiration_date') }}:</strong> {{ $inventory->expiration_date }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Mark') }}:</strong> {{ $inventory->mark }}</p>
                    <p><strong>{{ trans('senaempresa::menu.Inventory code') }}:</strong> {{ $inventory->inventory_code }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
