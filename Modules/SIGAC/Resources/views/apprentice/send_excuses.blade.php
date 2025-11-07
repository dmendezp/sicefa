@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('sigac::attendance.Breadcrumb_Active_Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::attendance.Breadcrumb_Attendance_Consult') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Digita tu número de documento</h3>
            <form class="row g-3 mt-2">
                <div class="d-flex justify-content-around">
                    <div>
                        <h4>Dia: 20/05/2023</h4>
                    </div>
                    <div>
                        <h4>Hora Actual: 07:23</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar"
                                aria-describedby="button-search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="button-search">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombre del Aprendiz</label>
                    <input type="text" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tecnologo</label>
                    <input type="text" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Hora de envio</label>
                    <input type="Datetime" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Dirección</label>
                    <input type="Datetime" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombre del instructor</label>
                    <input type="Datetime" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label for="inputState" class="form-label">Tipo</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>Llegada tarde</option>
                        <option>Inasistencia solo mañana</option>
                        <option>Inasistencia solo tarde</option>
                        <option>No asiste</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Cargar Excusa</label>
                    <input class="form-control" type="file" id="formFile">
                  </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enviar Excusa</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
