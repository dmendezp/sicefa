@extends('senaempresa::layouts.master')

@section('content')
<div class="container">
    <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
    <form method="GET"
        action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index') }}">
        <label for="positionFilter">Filtrar por cargo:</label>
        <select class="form-control" id="positionFilter" name="positionFilter" onchange="this.form.submit()">
            <option value="" {{ !$selectedPositionId ? 'selected' : '' }}>Todos los cargos</option>
            @foreach ($PositionCompanies as $PositionCompany)
            <option value="{{ $PositionCompany->id }}" {{ $selectedPositionId==$PositionCompany->id ? 'selected' : ''
                }}>
                {{ $PositionCompany->id }} {{ $PositionCompany->name }}
            </option>
            @endforeach
        </select>
    </form>

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
                            @foreach ($postulates as $postulate)
                            @if ($postulate->state === 'Inscrito' && $postulate->score_total === 0)
                            <th></th>
                            @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postulates as $postulate)
                        <tr>
                            <td>{{ $postulate->id }}</td>
                            <td>{{ $postulate->apprentice->id }} {{ $postulate->apprentice->person->full_name }}</td>
                            <td>{{ $postulate->vacancy->id }} {{ $postulate->vacancy->name }}</td>
                            <td>{{ $postulate->state }}</td>
                            <td>
                                <a href="{{ asset($postulate->cv) }}" class="btn btn-primary btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> CV
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset($postulate->personalities) }}" class="btn btn-primary btn-sm"
                                    download>
                                    <i class="fas fa-download fa-sm"></i> Personalidades
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset($postulate->proposal) }}" class="btn btn-primary btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> Propuesta
                                </a>
                            </td>
                            <td>{{ $postulate->score_total }}</td>

                            @if ($postulate->state === 'Inscrito' && $postulate->score_total === 0)
                            <td>

                                <a href="#" class="btn btn-primary btn-sm assign-button"
                                    data-apprentice-id="{{ $postulate->apprentice->id }}">Asignar</a>

                            </td>
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
@section('scripts')
<script>
    $(document).ready(function() {
            $('.assign-button').click(function(e) {
                e.preventDefault();

                var apprenticeId = $(this).data('apprentice-id');
                var redirectUrl =
                    "{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.assign_score', ['apprenticeId' => ':apprenticeId']) }}";
                redirectUrl = redirectUrl.replace(':apprenticeId', apprenticeId);

                window.location.href = redirectUrl;
            });
        });
</script>
@endsection