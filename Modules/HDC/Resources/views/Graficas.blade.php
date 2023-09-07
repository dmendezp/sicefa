@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Graficas</li>
@endpush

@section('content')
<div class="card">
        <div class="card-body">
    <h2 class="text-center">Graficas Huella De Carbono</h2>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h3> Mensual</h3>
    </div>
    <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Ambiental', 'Pecuaria','Agricola','Agroindustria',],
      datasets: [{
        label: 'Calculo de Huella',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }});

</script>

 <div class="card-body">
                <div class="col-7">
                <h4> Comparativa</h4>
                </div>
    <div>
  <canvas id="myChart"></canvas>
</div>
<div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Ambiental', 'Pecuaria','Agricola','Agroindustria',],
      datasets: [{
        label: 'Calculo de heulla',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }});
</div>
</script>

@endsection