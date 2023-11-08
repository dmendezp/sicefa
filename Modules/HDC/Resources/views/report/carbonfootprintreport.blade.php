@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::report.Report_Indicator') }}</li>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">{{ trans('hdc::report.Title_View_Report') }}</h2>
        <br>

        <div class="row mt-2 justify-content-center">
            <div class="col-md-6">
                <div class="card card-success card-outline shadow">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <label for="selectFilter">{{ trans('hdc::report.Quarterly_Card_Range_Title') }}</label>
                            <select class="form-control" id="selectFilter">
                                <option value="all" class="text-center">{{ trans('hdc::report.Subtitle_select_quarter') }}</option>
                                @foreach ($quarters as $quarter)
                                    <option value="{{ $quarter->id }}" class="text-center">
                                        {{ $quarter->name }} - {{ $quarter->start_date }} a {{ $quarter->end_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <form action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.generate.pdf') }}" method="post" id="pdfForm">
                                @csrf
                                <input type="hidden" name="selectedQuarterId" id="selectedQuarterId" value="">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-file-pdf mr-2"></i>{{ trans('hdc::report.Button_PDF') }}
                                </button>
                            </form>
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="div-reporte"></div>
    <br>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("change", "#selectFilter", function() {
                var selectedQuarterId = $(this).val();
                if (selectedQuarterId == '') {
                    $("#div-reporte").html('');
                } else {
                    var myObject = { selectedQuarterId: selectedQuarterId };
                    var myString = JSON.stringify(myObject);

                    ajaxReplace("div-reporte", '/hdc/{{ $role_name }}/report/tables', myString);

                    // Actualizar el valor del campo oculto en el formulario
                    $("#selectedQuarterId").val(selectedQuarterId);
                }
            });
        });
    </script>
@endpush



