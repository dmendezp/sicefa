@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"></li>
@endpush

@section('content')
    <h2 class="text-center">Consultar Aspectos Ambientales</h2>
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-success card-outline shadow mt-2">
                        <div class="card-header">
                            <a href="{{ route('hdc.admin.add.aspects') }}"><button type="submit" class="btn btn-success"><i class="fas fa-add"></i></button></a>
                        </div>
                        <div class="card-body">
                            <label>{{ trans('hdc::ConsumptionRegistry.Title_Card_Productive_Unit') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-list"></i>
                                    </span>
                                    <select class="form-select" name="productive_unit_id" id="productive_unit_id">
                                        <option value="">--{{ trans('hdc::ConsumptionRegistry.Select_Productive_Unit') }}--</option>
                                        @foreach ($productive_unit as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-success ml-2" id="btnSearch">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <div class="content" id="div-aspectos">

    </div>
@endsection

@push('scripts')
    <script>
        // Cuando se hace clic en el botón de búsqueda
        $(document).on("click", "#btnSearch", function() {
            var unit_id = $("#productive_unit_id").val();

            if (unit_id != '') {
                var myObjet = new Object();
                myObjet.productive_unit_id = unit_id;
                var myString = JSON.stringify(myObjet);
                ajaxReplace("div-aspectos", '/hdc/result/tabla/Aspects', myString);
            }

        });
    </script>

@endpush
