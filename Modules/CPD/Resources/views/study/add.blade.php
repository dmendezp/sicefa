@extends('cpd::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('cpd.admin.study.index') }}">Monitoreos</a>
    </li>
    <li class="breadcrumb-item">
        Registro
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-header py-2">
                            <h4><b>{{ $view['titleView'] }}</b></h4>
                        </div>
                        {!! Form::open(['route' => 'cpd.admin.study.store', 'method' => 'POST', 'role' => 'form']) !!}
                        <form>
                            <div class="card-body pb-0">
                                @include('cpd::study.form')
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('cpd.admin.study.index') }}" class="btn btn-light float-left" data-toggle='tooltip' data-placement="top" title="Cancelar registro">
                                    <b>Cancelar</b>
                                </a>
                                <button type="submit" class="btn btn-primary float-right" data-toggle='tooltip' data-placement="top" title="Registrar monitoreo">
                                    <b>Guardar</b>
                                </button>
                            </div>
                        </form>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')
    <script>
        function limitDecimalPlaces(e, count) {
            if (e.target.value.indexOf('.') == -1) {
                return;
            }
            if ((e.target.value.length - e.target.value.indexOf('.')) > count) {
                e.target.value = parseFloat(e.target.value).toFixed(count);
            }
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        //Initialize Select2 Element to producers
        $('#producer_id').select2({
            theme: 'bootstrap4',
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                }
            }
        });
        $('#village_id').select2({
            theme: 'bootstrap4',
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                }
            }
        });
    </script>
@endsection
