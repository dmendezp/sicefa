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
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body"><a
                        href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.selected.generatepdf') }}"
                        class="btn btn-primary">{{ trans('senaempresa::menu.Generate PDF') }}</a>
                    <table id="inventory" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('senaempresa::menu.Apprentice') }}</th>
                                <th>{{ trans('senaempresa::menu.Position') }}</th>
                                <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                <th>{{ trans('senaempresa::menu.Public employment agency certificate employment') }}</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                                <th>{{ trans('senaempresa::menu.Actions') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                @if ($postulate->state === 'Seleccionado')
                                    <tr>
                                        <td>{{ $postulate->id }}</td>
                                        <td>{{ $postulate->apprentice->person->full_name }}</td>
                                        <td>{{ $postulate->vacancy->positionCompany->name }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->cv) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #fe3e3e; font-size: 30px; text-align: center;"></i>

                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->personalities) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #483efe; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->proposal) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #08c651; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->employment_certificate) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #FC7430; font-size: 30px; text-align: center;"></i>

                                            </a>
                                        </td>
                                        <td>{{ $postulate->score_total }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#detailsModal{{ $postulate->id }}">
                                                {{ trans('senaempresa::menu.Details') }}
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="detailsModal{{ $postulate->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailsModalLabel">
                                                        {{ trans('senaempresa::menu.Postulate Details') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>{{ trans('senaempresa::menu.Postulate') }}:</strong>
                                                        {{ $postulate->apprentice->person->full_name }}</p>
                                                    <p><strong>{{ trans('senaempresa::menu.Document') }}:</strong>
                                                        {{ $postulate->apprentice->person->document_number }}</p>
                                                    <p><strong>{{ trans('senaempresa::menu.Email') }}:</strong>
                                                        {{ $postulate->apprentice->person->personal_email }}</p>
                                                    <p><strong>{{ trans('senaempresa::menu.Telephone') }}:</strong>
                                                        {{ $postulate->apprentice->person->telephone1 }}</p>
                                                    <p><strong>{{ trans('senaempresa::menu.Positon Id') }}:</strong>
                                                        {{ $postulate->vacancy->positionCompany->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
