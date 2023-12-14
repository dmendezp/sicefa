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
                                <th>Certificado agencia de empleo</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                @if ($postulate->state === 'Seleccionado')
                                    <tr>
                                        <td>{{ $postulate->id }}</td>
                                        <td>{{ $postulate->apprentice->person->full_name }}</td>
                                        <td>{{ $postulate->vacancy->name }}</td>
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
