@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Id') }}</th>
                                <th>{{ trans('senaempresa::menu.Apprentice Id') }}</th>
                                <th>{{ trans('senaempresa::menu.Vacancy ID') }}</th>
                                <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                @if ($postulate->state === 'Seleccionado')
                                    <tr>
                                        <td>{{ $postulate->id }}</td>
                                        <td>{{ $postulate->apprentice->person->full_name }}</td>
                                        <td>{{ $postulate->vacancy->id }} {{ $postulate->vacancy->name }}</td>

                                        <td>
                                            <a href="{{ asset($postulate->cv) }}" class="btn btn-primary btn-sm" download>
                                                <i class="fas fa-download fa-sm"></i> CV
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset($postulate->personalities) }}" class="btn btn-primary btn-sm"
                                                download>
                                                <i class="fas fa-download fa-sm"></i> <th>{{ trans('senaempresa::menu.Personality') }}</th>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset($postulate->proposal) }}" class="btn btn-primary btn-sm"
                                                download>
                                                <i class="fas fa-download fa-sm"></i> <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                            </a>
                                        </td>
                                        <td>{{ $postulate->score_total }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
