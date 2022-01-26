@extends('cafeto::layouts.admin')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">{{ __('Sales')}}</a></li>
<li class="breadcrumb-item"><a href="#">{{ __('Inventory')}}</a></li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"> {{ __('Inventory')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
    					<thead>
    						<tr>
    							<th>Id</th>
    							<th>Referencia</th>
    							<th>Nombre</th>
    							<th>Estado</th>
                  <th>uso</th>
    							<th>Accion</th>
    							
    						</tr>
    					</thead>
    					<tbody>
    					
    						<tr>
    							<td></td>
    							<td></td>
    							<td></td>
    							<td></td>
                  <td></td>
    							
    							
    							<td>
    								<div class="opts">
    							
    								<a  href="" data-toggle="tooltip" data-placement="top"  title="Editar"><i class="fas fa-pen"></i></a>&nbsp;

    								<a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="gymstorm/admin/gym/machinery" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

    							</div>
    						</td>
    					</tr>
    					 
    					
             
    					
    					</tbody>

    				</table>
                   

            {{-- <div id="example">

            </div> --}}
        </div>

    </div>
    <!-- /.card-body -->
</div>
    </div>
</div>

@endsection