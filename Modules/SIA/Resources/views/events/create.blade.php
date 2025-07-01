@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.events.index') }}" class="text-decoration-none">
            {{ trans('sia::eventsia.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::eventsia.create_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.events.store') }}" method="POST" id="form-event" enctype="multipart/form-data">
        @csrf
        <div class="card card-success card-outline mx-auto mb-3 custom-border-color">
            <div class="card-body">
                <div class="row">
                    <!-- Columna 1: Datos Básicos -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::eventsia.basic_data') }}</h5>
                        <div class="form-group">
                            <label for="name">{{ trans('sia::eventsia.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            @error('name')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="event_image">{{ trans('sia::eventsia.event_image') }}</label>
                            <input type="text" name="event_image" id="event_image" class="form-control" required>
                            @error('event_image')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">{{ trans('sia::eventsia.location') }}</label>
                            <input type="text" name="location" id="location" class="form-control" required>
                            @error('location')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 2: Datos de Fecha y Contacto -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::eventsia.date_contact_data') }}</h5>
                        <div class="form-group">
                            <label for="start_date">{{ trans('sia::eventsia.start_date') }}</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                            @error('start_date')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('sia::eventsia.end_date') }}</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            @error('end_date')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organizer">{{ trans('sia::eventsia.organizer') }}</label>
                            <input type="text" name="organizer" id="organizer" class="form-control" required>
                            @error('organizer')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_email">{{ trans('sia::eventsia.contact_email') }}</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control" required>
                            @error('contact_email')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_phone">{{ trans('sia::eventsia.contact_phone') }}</label>
                            <input type="number" name="contact_phone" id="contact_phone" class="form-control">
                            @error('contact_phone')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 3: Estado -->
                    <div class="col-md-12 mt-4">
                        <h5>{{ trans('sia::eventsia.status_data') }}</h5>
                        <div class="form-group">
                            <label for="status">{{ trans('sia::eventsia.status') }}</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">{{ trans('sia::eventsia.select_status') }}</option>
                                <option value="scheduled">{{ trans('sia::eventsia.status_scheduled') }}</option>
                                <option value="ongoing">{{ trans('sia::eventsia.status_ongoing') }}</option>
                                <option value="completed">{{ trans('sia::eventsia.status_completed') }}</option>
                                <option value="cancelled">{{ trans('sia::eventsia.status_cancelled') }}</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('sia.admin.events.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>{{ trans('sia::eventsia.action_cancel') }}</strong>
                </a>
                <button type="submit" class="btn btn-sm btn-success" id="btn-register-event">
                    <b>{{ trans('sia::eventsia.action_register') }}</b>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-event").submit(function() {
                $("#btn-register-event").prop("disabled", true);
                toastr.success('{{ trans("sia::eventsia.registering") }}', '{{ trans("sia::eventsia.processing") }}');
            });
        });
    </script>
@endpush