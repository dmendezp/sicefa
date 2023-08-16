<div>
        <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="environment" class="form-label">{{ trans('sigac::attendance.CardSubtitle1') }}</label>
                                <select id="environment" class="form-select" aria-label="Default select example">
                                    <option selected disabled>{{ trans('sigac::attendance.Select...') }}</option>
                                    @foreach ($environments as $environment)
                                        <option value="{{ $environment->id }}">{{ $environment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="technologist" class="form-label">{{ trans('sigac::attendance.CardSubtitle2') }}</label>
                                <select name="course_id" class="form-select" aria-label="Default select example" wire:model="course_id">
                                    <option value="">{{ trans('sigac::attendance.Select...') }}</option>
                                    @foreach ($programs as $program)
                                        @foreach ($program->courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $program->name }} ({{ $course->code }})
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="producto">{{ trans('sigac::attendance.Current date and time') }}</label>
                                        <p class="card-text" id="fecha-hora"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start-training"
                                            class="form-label">{{ trans('sigac::attendance.Start of training') }}</label>
                                        <p id="start-training">16/05/2023 12:50</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end-training"
                                            class="form-label">{{ trans('sigac::attendance.End of training') }}</label>
                                        <p id="end-training">16/05/2023 12:50</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="fas fa-plus"></i> {{ trans('sigac::attendance.Register Previous') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('sigac::attendance.Summary of the session') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <dl>
                                <dt>P</dt>
                                <dd>{{ trans('sigac::attendance.Total present:') }} 0</dd>
                            </dl>
                            <dl>
                                <dt>FJ</dt>
                                <dd>{{ trans('sigac::attendance.Total justified failures:') }} 0</dd>
                            </dl>
                        </div>
                        <div class="col-6">
                            <dl>
                                <dt>FI</dt>
                                <dd>{{ trans('sigac::attendance.Total unjustified failures:') }} 0</dd>
                            </dl>
                            <dl>
                                <dt>MD</dt>
                                <dd>{{ trans('sigac::attendance.Total missing stockings:') }} 0</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ trans('sigac::attendance.CardSubtitle2') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>{{ trans('sigac::attendance.Select...') }}</option>
                        <option value="1">Prueba 1</option>
                        <option value="2">Prueba 2</option>
                        <option value="3">Prueba 3</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ trans('sigac::attendance.Close') }}</button>
                    <button type="button" class="btn btn-success">{{ trans('sigac::attendance.Accept') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (empty($apprentices))
                        <div class="text-center">No se ha selecionado un curso</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableAttendance">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">{{ trans('sigac::attendance.Code') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.Name') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.Document Number') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.Accumulated Faults') }}</th>
                                        <th scope="col">{{ trans('sigac::attendance.Attendance') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apprentices as $a)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $a->person->full_name }}</td>
                                            <td>{{ $a->person->document_number }}</td>
                                            <td>1</td>
                                            <td>
                                                <select class="form-select form-select-sm my-select color-select"
                                                    aria-label=".form-select-sm example">
                                                    <option value="0">Seleccione</option>
                                                    <option value="1">P</option>
                                                    <option value="2">MF</option>
                                                    <option value="3">FJ</option>
                                                    <option value="4">FI</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
