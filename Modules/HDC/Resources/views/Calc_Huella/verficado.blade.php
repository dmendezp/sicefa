<div class="row justify-content-center">
    <div class="card card-success card-outline shadow col-md-12">
        <div class="card-header">
            <h2 class="card-title text-success text-center">Usuario registrado</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body box-profile">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nombre completo</label>
                        {!! Form::text('nombre_completo', $usuario->full_name, [
                            'class' => 'form-control',
                            'disabled',
                        ]) !!}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group">
                        <br>
                        <a href="{{--  {{ route('carbonfootprint.datos', $usuario->id) }}  --}}" class="btn btn-secondary">Calcular</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
