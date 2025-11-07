@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <div class="row">
            <div class="col">
                <form method="GET"
                    action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index') }}">
                    <label for="positionFilter">{{ trans('senaempresa::menu.Filter by job title:') }}</label>
                    <select class="form-control" id="positionFilter" name="positionFilter" onchange="this.form.submit()">
                        <option value="" {{ !$selectedPositionId ? 'selected' : '' }}>
                            {{ trans('senaempresa::menu.All charges') }}</option>
                        @foreach ($PositionCompanies as $PositionCompany)
                            <option value="{{ $PositionCompany->id }}"
                                {{ $selectedPositionId == $PositionCompany->id ? 'selected' : '' }}>
                                {{ $PositionCompany->id }} {{ $PositionCompany->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
            @if (Route::is('senaempresa.admin.*') &&
                    Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.cv'))
                <div class="col">
                    <label for="showAssignedScore">{{ trans('senaempresa::menu.Show Score:') }}</label>
                    <select class="form-control" id="showAssignedScore" name="showAssignedScore"
                        onchange="this.form.submit()">
                        <option value=""> {{ trans('senaempresa::menu.All') }}</option>
                        <option value="assigned" {{ $showAssignedScore == 'assigned' ? 'selected' : '' }}>
                            {{ trans('senaempresa::menu.With Assigned Score') }}
                        </option>
                        <option value="unassigned" {{ $showAssignedScore == 'unassigned' ? 'selected' : '' }}>
                            {{ trans('senaempresa::menu.No Score Assigned') }}
                        </option>
                    </select>
                </div>
            @endif
            </form>
        </div>
        <br>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="inventory" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>{{ trans('senaempresa::menu.Apprentice') }}</th>
                                <th>{{ trans('senaempresa::menu.Vacancy') }}</th>
                                @if (Route::is('senaempresa.admin.*') &&
                                        Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.cv'))
                                    <th>{{ trans('senaempresa::menu.Currículum') }}</th>
                                    <th>{{ trans('senaempresa::menu.Proposal') }}</th>
                                    <th>{{ trans('senaempresa::menu.Public employment agency certificate employment') }}
                                    </th>
                                @endif
                                @if (Route::is('senaempresa.psychologo.*') &&
                                        Auth::user()->havePermission(
                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.personalities'))
                                    <th>{{ trans('senaempresa::menu.16 personalities') }}</th>
                                @endif
                                <th>{{ trans('senaempresa::menu.Total score') }}</th>
                                <th>{{ trans('senaempresa::menu.Assign Score') }}</th>
                                @if (Route::is('senaempresa.admin.*') &&
                                        Auth::user()->havePermission(
                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.state'))
                                    <th>
                                        {{ trans('senaempresa::menu.Update Status') }}
                                    </th>
                                @endif
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                @if ($postulate->state === 'Inscrito')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $postulate->apprentice->person->full_name }}</td>
                                        <td>{{ $postulate->vacancy->name }}</td>
                                        @if (Route::is('senaempresa.admin.*') &&
                                                Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.cv'))
                                            <td style="text-align: center;">
                                                <a href="{{ asset($postulate->cv) }}" download>
                                                    <i class="far fa-file-pdf"
                                                        style="color: #fe3e3e; font-size: 30px; text-align: center;"></i>
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
                                        @endif
                                        @if (Route::is('senaempresa.psychologo.*') &&
                                                Auth::user()->havePermission(
                                                    'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.personalities'))
                                            <td style="text-align: center;">
                                                <a href="{{ asset($postulate->personalities) }}" download>
                                                    <i class="far fa-file-pdf"
                                                        style="color: #483efe; font-size: 30px; text-align: center;"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td>{{ $postulate->score_total }}</td>
                                        @if ($postulate->score_total === 0)
                                            <td>
                                                @if (Route::is('senaempresa.psychologo.*') &&
                                                        Auth::user()->havePermission(
                                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.personalities'))
                                                    @if (!$postulate->file_senaempresa || $postulate->file_senaempresa->personalities_score === null)
                                                        <a href="#" class="btn btn-primary btn-sm assign-button"
                                                            data-apprentice-id="{{ $postulate->apprentice->id }}"
                                                            data-vacancy-id="{{ $postulate->vacancy->id }}">
                                                            {{ trans('senaempresa::menu.To assign') }}
                                                        </a>
                                                    @else
                                                        <p> {{ trans('senaempresa::menu.Score Assigned') }}</p>
                                                    @endif
                                                @elseif (Route::is('senaempresa.admin.*') &&
                                                        Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.cv'))
                                                    @if (
                                                        !$postulate->file_senaempresa ||
                                                            ($postulate->file_senaempresa->cv_score === null && $postulate->file_senaempresa->proposal_score === null))
                                                        <a href="#" class="btn btn-primary btn-sm assign-button"
                                                            data-apprentice-id="{{ $postulate->apprentice->id }}"
                                                            data-vacancy-id="{{ $postulate->vacancy->id }}">
                                                            {{ trans('senaempresa::menu.To assign') }}
                                                        </a>
                                                    @else
                                                        <p> {{ trans('senaempresa::menu.Score Assigned') }}</p>
                                                    @endif
                                                    <td>
                                                        <p>{{ trans('senaempresa::menu.Score to be assigned') }}</p>
                                                    </td>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                <p> {{ trans('senaempresa::menu.Score Assigned') }}</p>
                                            </td>
                                            @if (
                                                $postulate->score_total > 0 &&
                                                    (Route::is('senaempresa.admin.*') &&
                                                        Auth::user()->havePermission(
                                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.state')))
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm state-button"
                                                        data-apprentice-id="{{ $postulate->apprentice->id }}"
                                                        data-vacancy-id="{{ $postulate->vacancy->id }}">
                                                        {{ trans('senaempresa::menu.To update') }}
                                                    </a>
                                                </td>
                                            @endif
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
