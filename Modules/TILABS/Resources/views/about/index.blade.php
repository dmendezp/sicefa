@extends('tilabs::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('tilabs::about.Title_Project') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">{{ trans('tilabs::about.Text_Project_Origin') }}</span>
                                        <span class="info-box-number text-center text-muted mb-0">2014</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">{{ trans('tilabs::about.Text_Project_Current_Status') }}</span>
                                        <span class="info-box-number text-center text-muted mb-0">En desarrollo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">{{ trans('tilabs::about.Text_Project_Reach') }}</span>
                                        <span class="info-box-number text-center text-muted mb-0">CEFA - "La Angostura"</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-laptop-house"></i> TI-LABS</h3>
                        <p class="text-muted">{{ trans('tilabs::about.Text_Project_Info') }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">{{ trans('tilabs::about.Text_Project_Company') }}
                                <b class="d-block">Centro de Formación "La Angostura"</b>
                            </p>
                            <p class="text-sm">{{ trans('tilabs::about.Text_Project_Leader') }}
                                <b class="d-block">{{ trans('tilabs::about.Text_Project_Leader_Name') }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
