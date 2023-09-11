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
                @foreach($aspectosAmbientales as $aspecto)
                    <tr>
                        {{--  <td>{{ $aspecto->name }}</td>  --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-around">
            <a href="#" class="btn btn-success">Agregar</a>
        </div>
    </div>
</div>

