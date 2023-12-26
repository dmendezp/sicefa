@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="inventory" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('senaempresa::menu.Apprentice') }}</th>
                                <th>{{ trans('senaempresa::menu.Vacancy') }}</th>
                                <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                <th>{{ trans('senaempresa::menu.State') }}</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                        </thead>
                        <tbody>
                            @foreach($postulations as $postulation)
                                    <tr>
                                        <td>{{ $postulation->id }}</td>
                                        <td>{{ $postulation->apprentice->person->full_name }}</td>
                                        <td>{{ $postulation->vacancy->name }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulation->cv) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #fe3e3e; font-size: 30px; text-align: center;"></i>

                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulation->personalities) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #483efe; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulation->proposal) }}" download>
                                                <i class="far fa-file-pdf"
                                                    style="color: #08c651; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td>{{ $postulation->state }}</td>
                                        <td>{{ $postulation->score_total }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
