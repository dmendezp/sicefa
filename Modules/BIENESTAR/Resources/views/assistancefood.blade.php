
@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>Registro de Asistencia de Alimentación <i class="fas fa-pizza-slice"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">
            

                <!-- Cuadro con la tabla -->
                <div class="table-responsive">
                    <table id="datatable" class="table mt-4" style="width:100%">
                        <thead>
                            <tr>
                               <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                <th>{{ trans('bienestar::menu.Number Document')}}</th>
                                <th>{{ trans('bienestar::menu.Beneficiary')}}</th>
                                <th>{{ trans('bienestar::menu.Program')}}</th>
                                <th>{{ trans('bienestar::menu.code')}}</th>
                                <th>{{ trans('bienestar::menu.percentage')}}</th>
                                <th>{{ trans('bienestar::menu.time and date')}}</th>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection