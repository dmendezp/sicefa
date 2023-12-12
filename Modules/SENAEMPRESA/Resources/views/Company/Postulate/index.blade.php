@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <div class="row">
            <div class="col">
                <form method="GET"
                    action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index') }}">
                    <label for="positionFilter">Filtrar por cargo:</label>
                    <select class="form-control" id="positionFilter" name="positionFilter" onchange="this.form.submit()">
                        <option value="" {{ !$selectedPositionId ? 'selected' : '' }}>Todos los cargos</option>
                        @foreach ($PositionCompanies as $PositionCompany)
                            <option value="{{ $PositionCompany->id }}"
                                {{ $selectedPositionId == $PositionCompany->id ? 'selected' : '' }}>
                                {{ $PositionCompany->id }} {{ $PositionCompany->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
            <div class="col">
                <label for="showAssignedScore">Mostrar Puntaje:</label>
                <select class="form-control" id="showAssignedScore" name="showAssignedScore" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="assigned" {{ $showAssignedScore == 'assigned' ? 'selected' : '' }}>Con Puntaje
                        Asignado
                    </option>
                    <option value="unassigned" {{ $showAssignedScore == 'unassigned' ? 'selected' : '' }}>Sin Puntaje
                        Asignado
                    </option>
                </select>
                </form>
            </div>
        </div>
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
                                <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                                <th>Asignar Puntaje</th>
                                @if ($score_total->isNotEmpty())
                                    <th>
                                        Actualizar Estado
                                    </th>
                                @endif
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                @if ($postulate->state === 'Inscrito')
                                    <tr>
                                        <td>{{ $postulate->id }}</td>
                                        <td>{{ $postulate->apprentice->person->full_name }}</td>
                                        <td>{{ $postulate->vacancy->id }} {{ $postulate->vacancy->name }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->cv) }}" download>
                                                <i class="far fa-file-pdf" style="color: #fe3e3e; font-size: 30px; text-align: center;"></i>

                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->personalities) }}" download>
                                                <i class="far fa-file-pdf" style="color: #483efe; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ asset($postulate->proposal) }}" download>
                                                <i class="far fa-file-pdf" style="color: #08c651; font-size: 30px; text-align: center;"></i>
                                            </a>
                                        </td>
                                        <td>{{ $postulate->score_total }}</td>

                                        @if ($postulate->score_total === 0)
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm assign-button"
                                                    data-apprentice-id="{{ $postulate->apprentice->id }}"
                                                    data-vacancy-id="{{ $postulate->vacancy->id }}">
                                                    Asignar
                                                </a>
                                            </td>
                                            <td>
                                            </td>
                                        @else
                                            <td>
                                                <p>Puntaje Asignado</p>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm state-button"
                                                    data-apprentice-id="{{ $postulate->apprentice->id }}"
                                                    data-vacancy-id="{{ $postulate->vacancy->id }}">
                                                    Actualizar
                                                </a>
                                            </td>
                                        @endif
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.assign-button').click(function(e) {
                e.preventDefault();

                var apprenticeId = $(this).data('apprentice-id');
                var vacancyId = $(this).data('vacancy-id');

                // Append the vacancyId to the redirect URL
                var redirectUrl =
                    "{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.assign_score', ['apprenticeId' => ':apprenticeId', 'vacancyId' => ':vacancyId']) }}";
                redirectUrl = redirectUrl.replace(':apprenticeId', apprenticeId).replace(':vacancyId',
                    vacancyId);

                window.location.href = redirectUrl;
            });
        });

        $(document).ready(function() {
            $('.state-button').click(function(e) {
                e.preventDefault();
                var apprenticeId = $(this).data('apprentice-id');
                var redirectUrl =
                    "{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.state', ['apprenticeId' => ':apprenticeId']) }}";
                redirectUrl = redirectUrl.replace(':apprenticeId', apprenticeId);

                window.location.href = redirectUrl;
            });
        });
    </script>
@endsection
