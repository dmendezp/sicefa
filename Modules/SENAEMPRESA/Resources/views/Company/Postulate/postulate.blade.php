@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <br>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Id') }}</th>
                                <th>{{ trans('senaempresa::menu.Apprentice Id') }}</th>
                                <th>{{ trans('senaempresa::menu.Vacancy ID') }}</th>
                                <th>{{ trans('senaempresa::menu.Status') }}</th>
                                <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                <tr>
                                    <td>{{ $postulate->id }}</td>
                                    <td>{{ $postulate->apprentice->person->first_name }}
                                        {{ $postulate->apprentice->person->first_last_name }}</td>
                                    <td>{{ $postulate->vacancy->name }}</td>
                                    <td>{{ $postulate->state }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $postulate->cv) }}" class="btn btn-primary btn-sm"
                                            download>
                                            <i class="fas fa-download fa-sm"></i> CV
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $postulate->personalities) }}"
                                            class="btn btn-primary btn-sm" download>
                                            <i class="fas fa-download fa-sm"></i> Personalidades
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $postulate->proposal) }}"
                                            class="btn btn-primary btn-sm" download>
                                            <i class="fas fa-download fa-sm"></i> Propuesta
                                        </a>
                                    </td>

                                    <td>{{ $postulate->score_total }}</td>
                                    @if ($postulate->state === 'Inscrito')
                                        <td>
                                            <a href="{{ route('company.postulate.score') }}"
                                                class="btn btn-primary btn-sm">Asignar</a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
