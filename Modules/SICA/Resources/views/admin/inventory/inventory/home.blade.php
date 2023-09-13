@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-4">
        <div class="card-header">
          <h3 class="card-title">Inventory</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Timelime example  -->

          <div class="form_search" id="form_search">
            <div class="row">
              <div class="col-md-8">
                {!! Form::select('warehouse_id', $warehouses, null, ['class'=>'custom-select', 'placeholder'=>'Seleccione Bodega','id'=>'warehouse_id']) !!}
              </div>
              <div class="col-md-2">
                {!! Form::button('Buscar', ['class' => 'btn btn-primary','id'=>'btnBuscarApprentices']) !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="divApprentices">
      
    </div>

  </div>



</div>

@endsection