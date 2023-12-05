@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4"> Asistencia de Alimentacion <i class="fas fa-bus-alt"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="Ingrese su número el documento" id="assitances">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButtonassitance"><i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="divAssitances">
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on("change", "#assitances", function() {
        performSearch();
    });

    $(document).on("click", "#searchButtonassitance", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
    });

    function performSearch() {
    var miObjeto = new Object();
    miObjeto = $('#assitances').val();
    var data = JSON.stringify(miObjeto);
    console.log("Data being sent:", data); // Agregar este console.log

    ajaxReplace('divAssitances', '/bienestar/admin/food_assistance/search', data);
}

</script>
@endsection