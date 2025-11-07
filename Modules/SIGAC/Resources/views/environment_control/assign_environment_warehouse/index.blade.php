@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Asigancion de Bodega al Ambiente</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sigac.instructor.environmentcontrol.assign_environment_warehouse.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('environment',  trans('Ambiente')) !!}
                                        {!! Form::select('environment', $environments,  old('environment'), ['class' => 'form-control environment', 'required' ,],) !!}                                         
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('warehouse',  trans('Bodegas')) !!}
                                        {!! Form::select('warehouse', $warehouses, old('warehouse'), ['class' => 'form-control warehouse', 'required' ,],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('instructor',  trans('Instructor')) !!}
                                        {!! Form::select('instructor', $instructors, old('instructor'), ['class' => 'form-control instructor', 'required' ,],) !!}                                    
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div id="professions">
                                    @include('sigac::environment_control.assign_environment_warehouse.table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#professionxprogram').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });
        $('.instructor').select2();
    });
</script>
