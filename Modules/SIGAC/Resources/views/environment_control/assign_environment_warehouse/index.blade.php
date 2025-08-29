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
                                <form action="{{ route('sigac.academic_coordination.environmentcontrol.assign_environment_warehouse.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('productive_units',  trans('Unidad Productiva')) !!}
                                        {!! Form::select('productive_units', $productive_units, old('productive_unit'), ['class' => 'form-control productive_unit', 'required' ,],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('warehouse',  trans('Bodega')) !!}
                                        {!! Form::select('warehouse', [''], old('warehouse'), ['class' => 'form-control warehouse', 'required' ,],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('environment',  trans('Ambiente')) !!}
                                        {!! Form::select('environment', $environments,  old('environment'), ['class' => 'form-control environment', 'required' ,],) !!}                                         
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
        $('.productive_unit').select2();
        $('.warehouse').select2();
        $('.environment').select2();

        $('.productive_unit').on('change', function () {
            var selectedUnit = $(this).val();

            $.ajax({
                url: '{{ route('sigac.academic_coordination.environmentcontrol.assign_environment_warehouse.searchwarehouses') }}',
                method: 'GET',
                data: {
                    productive_unit_id: selectedUnit
                },
                success: function(response) {
                    console.log(response);
                    if (response.warehouses) {
                        
                        var warehouseSelect = $('.warehouse').last();
                        warehouseSelect.empty();
                        $.each(response.warehouses, function(id , name) {
                            warehouseSelect.append(new Option(name, id));
                        });
                    }
                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });

        });
    });
</script>
