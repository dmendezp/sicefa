@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.report') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de inventario</li>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-4 mb-3 mb-sm-0">
        <form action="{{ route('ptventa.report.report_results') }}" method="POST">
            @csrf
            <div class="card w-80 mb-3 card-success card-outline shadow-sm">
                <div class="card-body">
                    <label>Fecha inicial</label>
                    <input type="date" value="{{ old('fecha_ini')}}" id="fecha_ini" name="fecha_ini" class="form-control" required>

                    <label>Fecha final</label>
                    <input type="date" value="{{old('fecha_fin')}}" id="fecha_fin" name="fecha_fin" class="form-control" >
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Consultar</button>
                </div>
            </div>

        </form>
    </div>
    <div class="col-sm-8 mb-3 mb-sm-0">
        <div class="card w-80 mb-3 card-success card-outline shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-11">
                        Reporte
                    </div>
                    <div class="col-1">
                        <a href="#" class="btn btn-danger btn-sm"> <strong>PDF</strong> </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Fecha entrada</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Subtotal</th>
                        </thead>
                        <tbody class="table-group-divider">
                                <tr>
                                    <td class="text-center">uuu</td>
                                    <td class="text-center">knojn</td>
                                    <td class="text-center">uyvfycvcy</td>
                                    <td class="text-center">yvuvii</td>
                                    <td class="text-center">kmogmnotg</td>
                                </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
  @endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
<script>
    window.onload = function(){
        var fecha = new Date(); //fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agregar cero si es menor de 10
        if(mes<10)
          mes='0'+mes; //agregar cero si es menor de 10
        document.getElementById('fecha_fin').value=ano+"-"+mes+"-"+dia;

    }
</script>
@endpush
