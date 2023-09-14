@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::Graficas.Graphics')}}</li>
@endpush

@section('content')
  <div class="card">
  <div class="row col-12">
    <div class="card-body">
      <h2 class="text-center">{{ trans('hdc::Graficas.Carbon_Footprint_Graphics')}}</h2>
        <hr>
        <div class="col-4">
          <h3 class="text-center"> {{ trans('hdc::Graficas.Monthly')}}</h3>
          <div class="row"></div>
      <canvas id="myChart"></canvas>
        </div>
    <div>
      
  </div>


  @push('scripts')
  <!-- Funcion de la tabla Mensual -->
  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['{{ trans('hdc::Graficas.Environmental') }}', '{{ trans('hdc::Graficas.Livestock') }}','{{ trans('hdc::Graficas.Agricultural') }}','{{ trans('hdc::Graficas.Agroindustry') }}'],
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

  @endpush
@endsection