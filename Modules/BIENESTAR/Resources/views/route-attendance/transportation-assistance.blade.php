@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4"> Asistencia de Ruta de Transporte <i class="fas fa-bus-alt"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="Ingrese su número el documento" id="assitance">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButtonassitance"><i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="divAssitance">
    </div>
</div>
<script>
    $(document).on("change", "#assitance", function() {
        performSearch();
    });

    $(document).on("click", "#searchButtonassitance", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
    });

    function performSearch() {
        var miObjeto = new Object();
        miObjeto = $('#assitance').val();
        var data = JSON.stringify(miObjeto);
        console.log(miObjeto);
        ajaxReplace('divAssitance', '/bienestar/admin/transportation_asistance/search', data);
        
    }
</script>
@endsection