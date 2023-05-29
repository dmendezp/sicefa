@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.form') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de producto</li>
@endpush

@section('content')
<form action="{{ route('ptventa.report.form') }}" method="POST">
<div class="card w-50 mb-3">
    <div class="card-body">
        <label>Fecha inicial</label>
        <input type="date" value="{{old('fecha_ini')}}" id="fecha_ini" name="fecha_ini" class="form-control" required>

        <label>Fecha final</label>
        <input type="date" value="{{old('fecha_fin')}}" id="fecha_fin" name="fecha_fin" class="form-control" required>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-succes btn-sm">Consultar</button>
    </div>
  </div>

</form>
  @endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
<script>
    window.onload = function(){
        var fecha = new.Date(); //fecha actual
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
