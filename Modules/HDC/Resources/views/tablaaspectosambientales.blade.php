<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($as as $aspecto)
                <tr>
                    <td>{{ $aspecto['name'] }}</td>
                    <td><input class="form-control" type="number"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-around">
            <a href="#" class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</a>
        </div>
    </div>
</div>
