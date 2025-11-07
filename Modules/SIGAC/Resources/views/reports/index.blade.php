@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::reports.Breadcrumb_Active_Reports') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::reports.Breadcrumb_Reports_Attendance') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <span>{{ trans('sigac::reports.Text_Card_Select') }}</span>
            <hr>
            <div class="row align-items-center">
                <div class="col-md-6 mb-3">
                    <label for="report" class="form-label">{{ trans('sigac::reports.Title_Select_Techologist') }}</label>
                    <select id="report" class="form-select" aria-label="Default select example">
                        <option selected disabled>{{ trans('sigac::reports.Select') }}</option>
                        <option value="1">Prueba 1</option>
                        <option value="2">Prueba 2</option>
                        <option value="3">Prueba 3</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <a href="" class="btn btn-danger me-2"><i class="fa-solid fa-file-pdf"></i>
                            {{ trans('sigac::reports.Btn_PDF') }}</a>
                        <a href="" class="btn btn-success"><i class="fa-solid fa-file-excel"></i>
                            {{ trans('sigac::reports.Btn_Excel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('sigac::reports.Title_Card_Results') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span
                                        class="info-box-text text-center text-muted">{{ trans('sigac::reports.Title_Card_Latest_Training') }}</span>
                                    <span class="info-box-number text-center text-muted mb-0">20</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span
                                        class="info-box-text text-center text-muted">{{ trans('sigac::reports.Title_Card_Registered_Apprentices') }}</span>
                                    <span class="info-box-number text-center text-muted mb-0">20</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span
                                        class="info-box-text text-center text-muted">{{ trans('sigac::reports.Title_Card_Retired_Apprentices') }}</span>
                                    <span class="info-box-number text-center text-muted mb-0">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <h3 class="text-info"><i class="fa-solid fa-school"></i> {{ trans('sigac::reports.Title_Card_Name') }}</h3>
                    <p class="text-muted">{{ trans('sigac::reports.Text_Card_Description') }}</p>
                    <span></span>
                    <br>
                    <div class="text-muted">
                        <p class="text-sm">{{ trans('sigac::reports.Text_Card_Lead_Instructor') }}
                            <b class="d-block">User 1213232</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
