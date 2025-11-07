@extends( Request::is('bolmeteor/graficas') ? 'bolmeteor::layouts.master' : 'bolmeteor::layouts.admin')

@section('title','Home')
@section('breadcrumb')
<li class="breadcrumb-item active">
   <a href="{{ route('bolmeteor.estacion.index') }}"><i class="fas fa-home"></i> {{ __('Boletín Meteorológico') }}</a>
</li>
@endsection
@section('content')
<!-- Main content -->
<div class="content">
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="card card-green card-outline shadow col-md-12 ">
            <div class="card-header">
               <h3 class="card-title">Filtro de Busqueda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               {!! Form::open(['url' => route('bolmeteor.general.graficas.search')]) !!}
               <div class="row">
                  <div class="col-md-4">
                     <label for="name">Sensores :</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           <i class="fab fa-creative-commons-sampling"></i>
                           </span>
                        </div>
                        {!! Form::select('sensor', $sensors, @$_REQUEST['sensor'], ['class'=>'form-control','id' => 'sensor']) !!}
                     </div>
                  </div>
                  <div class="col-md-8">
                     <label for="name">Gráficas :</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           <i class="fa fa-bars" aria-hidden="true"></i>
                           </span>
                        </div>
                        {!! Form::select('variable', $variables, @$_REQUEST['variable'], ['class'=>'form-control','id' => 'variable','required' => 'required']) !!}
                     </div>
                  </div>
                  <div class="col-md-3"
                  <label for="start_date" >Inicia:</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                        <i class="far fa-calendar-alt"></i>
                        </span>
                     </div>
                     {{ Form::input('date', 'start_date', @$_REQUEST['start_date'], ['id' => 'game-date-time-text', 'class' => 'form-control','required' => 'postValuesSearch']) }}
                  </div>
               </div>
               <div class="col-md-3"
               <label for="end_date" >Termina:</label>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">
                     <i class="far fa-calendar-alt"></i>
                     </span>
                  </div>
                  {{ Form::input('date', 'end_date', @$_REQUEST['end_date'], ['id' => 'game-date-time-text', 'class' => 'form-control', 'required' => 'postValuesSearch']) }}
               </div>
            </div>
            <div class="col-md-3"
            <label for="name">Agrupar por:</label>
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                  <i class="fas fa-layer-group"></i>
                  </span>
               </div>
               {!! Form::select('agrupacion', $agrupados,@$_REQUEST['agrupacion'], ['class'=>'form-control','id' => 'agrupacion', 'required' => 'required']) !!}
            </div>
         </div>
         <div class="col-md-3"
         <label for="name">Función estadistica:</label>
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text" id="basic-addon1">
               <i class="fas fa-layer-group"></i>
               </span>
            </div>
            {!! Form::select('estadistica', @$estadisticas, @$_REQUEST['estadistica'], ['class' => 'form-control', 'id' => 'estadistica', 'required' => 'required']) !!}
         </div>
      </div>
   </div>
   {!! Form::submit('Buscar',['class'=>'btn btn-warning mtop16']) !!}
   {!! Form::close() !!}
</div>
<!-- /.card-body -->
</div>
<script>
    $(document).ready(function(){
        // INICIALIZAR VARIABLES
        var sensors = {!!  json_encode($sensors) !!};
        var variables = {!! json_encode($variables) !!};
        var agrupaciones = {!! json_encode($agrupados) !!};
        var estadisticas = {!! json_encode($estadisticas) !!};
        // estadistica
        var agrupacion = null;
        var estadistica = null;
        @if (@$_REQUEST['agrupacion'])
          agrupacion = {!! @$_REQUEST['agrupacion'] !!};
        @endif
        @if (@$_REQUEST['estadistica'])
          estadistica = {!! @$_REQUEST['estadistica'] !!};
        @endif
        // validar el tipo de grafica
        $("#variable").change(function(e,a,b){
            switch ($(this).val()) {
            case "1":// Temperatura
                // Máximo minimo promedio
                llenarselect([1,2,3],agrupaciones, '#agrupacion', agrupacion);
                llenarselect([0,1,2],estadisticas, '#estadistica',estadistica);
                break;
            case "2":// Humedad relativa promedio
                llenarselect([1,2,3],agrupaciones, '#agrupacion', agrupacion);
                llenarselect([0,2],estadisticas, '#estadistica',estadistica);
                break;
            case "3":// Radiación solar promedio
                llenarselect([1,2,3,],agrupaciones, '#agrupacion', agrupacion);
                llenarselect([0,2],estadisticas, '#estadistica',estadistica);
                break;
            case "4": // Precipitacion
                llenarselect([1,2,3],agrupaciones, '#agrupacion', agrupacion);
                llenarselect([3],estadisticas, '#estadistica',estadistica);
                break;
            case "5":// Rosa de los vientos
                llenarselect([1,2,3],agrupaciones, '#agrupacion', agrupacion);
                llenarselect([0],estadisticas, '#estadistica',estadistica);
                break;
            }
        });
        $('#variable').trigger('change');
        function llenarselect(ids, option, selector, valor){
            $(selector).empty();
            $.each(ids,function(i,v){
                $(selector).append('<option value="'+v+'">'+option[v]+'</option>');
            });
            $(selector).val(valor);
        }
    });
</script>
@if (@$_REQUEST['variable'] != 5)
@if (isset($values)) 
@foreach ($values as $variables)
<div class="card card-green card-outline shadow col-md-12 ">
   <div class="card-header">
      <h3 class="card-title"> Graficas {{ $variables['variable'] }}</h3>
   </div>
   <!-- /.card-header -->
   <figure class="highcharts-figure">
      <div id="grafica{{ $variables['id'] }}"></div>
   </figure>
   <script>
      Highcharts.chart('grafica{{ $variables['id'] }}', {
        @if (@$_REQUEST['variable'] == 4)
            chart: {
                type: 'column'
            },
        @endif
        title: {
          text: '{{ $sensor_name[@$_REQUEST['sensor']] }} -> {{ $variables['variable'] }}'
        }, 
      
        subtitle: {
          text: 'SENA-SENNOVA'
        },
      
      
        xAxis: {
          categories: [
            @foreach($variables['values'] as $datos)
              '{{ $datos['date_time'] }}',
          @endforeach
              ]
      },
      yAxis: {
          title: {
              text: '{{$variables['variable']}}'
          },
          labels: {
              formatter: function () {
                  return this.value + '{{ $variables['unit'] }}';
              }
          }
      },
      
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },
      
        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
            }
          }
        },
      
        series: [{
          name: '{{ $variables['variable'] }}',
          data: [
            @foreach ($variables['values'] as $datosn ) 
            {{ $datosn['value'] }},
      
            @endforeach
          ]
       
        }],
      
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      
      });
   </script>
</div>
</div>
@endforeach
@endif
@endif


@if (@$_REQUEST['variable'] == 5)
@foreach ($values as $variables)

<div class="card card-green card-outline shadow col-md-12 ">
<div class="card-header">
      <h3 class="card-title"> Graficas {{ $variables['variable'] }}</h3>
   </div>
<div id="container" style="min-width: 420px; max-width: 600px; height: 400px; margin: 0 auto"></div>
<div style="display:none">
    <!-- Source: http://or.water.usgs.gov/cgi-bin/grapher/graph_windrose.pl -->
    <table id="freq" border="0" cellspacing="0" cellpadding="0">
        <tr nowrap bgcolor="#CCCCFF">
            <th colspan="9" class="hdr">Table of Frequencies (percent)</th>
        </tr>
    </table>
</div>
</div>
<script>
$(function () {
  var variables = {!! json_encode(isset($variables['values'])? $variables['values'] :[]) !!}
// Parse the data from an inline table using the Highcharts Data plugin
$('#container').highcharts({
    chart: {
        polar: true,
        type: 'column'
    },

    title: {
      text: '{{ $sensor_name[@$_REQUEST['sensor']] }} -> {{ $variables['variable'] }}'
    },

    subtitle: {
      text: 'SENA-SENNOVA'
    },

    pane: {
        size: '85%'
    },

    legend: {
        align: 'right',
        verticalAlign: 'top',
        y: 100,
        layout: 'vertical'
    },

    xAxis: {
        tickmarkPlacement: 'on'
    },

    yAxis: {
        min: 0,
        endOnTick: false,
        showLastLabel: true,
        title: {
            text: 'Frequency (%)'
        },
        labels: {
            formatter: function () {
                return this.value + '%';
            }
        }
    },

    tooltip: {
        valueSuffix: '%'
    },

    plotOptions: {
        series: {
            stacking: 'normal',
            shadow: false,
            groupPadding: 0,
            pointPlacement: 'on'
        }
    },
    series: {!! json_encode(isset($variables['values'])? $variables['values'] :[]) !!}
});
});
</script>
@endforeach
@endif
</div>
</div>
</div>
@stop