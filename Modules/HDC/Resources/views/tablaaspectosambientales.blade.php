<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Aspectos Ambientales</th>
                    <th>Cantidad</th>
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
            <a href="#" class="btn btn-success">Guardar</a>
        </div>
    </div>
</div>
