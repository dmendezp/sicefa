@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"></li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title">
                    <strong>{{ $person->full_name }}
                        {{ trans('hangarauto::') }}
                    </strong>
                </h2>
            </div>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <form method="post" action="{{ route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.Fuel.save_consumption') }}">
                        @csrf
                        <input type="hidden" name="person_id" value="{{ $person->id}}">

                        <div class="form-group row">
                            <!-- Campo Para El Mes -->
                            <label for="mes" class="col-md-2 col-form-label text-md-right">Mes</label>
                            <div class="col-md-3">
                                <select name="mes" id="mes" class="form-control">
                                    <option value="" disabled selected>--- Seleccione El Mes ---</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ strftime('%B', mktime(0, 0, 0, $i, 1, 2000)) }}">{{ strftime('%B', mktime(0, 0, 0, $i, 1, 2000)) }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Campo Para El Año -->
                            <label for="anio" class="col-md-2 col-form-label text-md-right">Año</label>
                            <div class="col-md-3">
                                <select name="anio" id="anio" class="form-control">
                                    <option value="" disabled selected>--- Seleccione El Año ---</option>
                                    @for ($i = (date('Y') - 10); $i <= (date('Y') + 10); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" id="myTableform">
                            <thead class="table-dark">
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection