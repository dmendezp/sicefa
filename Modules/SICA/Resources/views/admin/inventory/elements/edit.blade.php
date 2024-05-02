@section('stylesheet')
@endsection

    <div id="content-config" style="width: 600px; height: 400px">
        <div class="modal-header py-2">
            <h5 class="modal-title" id="exampleModalLabel">
                <b>{{trans('sica::menu.Update Quarter')}}</b>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="card-body pb-1">
                @include('sica::admin.inventory.elements.form')
            </div>
            <div class="card-footer py-2 text-right">
                {!! Form::submit( trans('sica::menu.Register'), ['class'=>'btn btn-primary btn-md py-0 float-right']) !!}
                <a href="{{ route('sica.admin.inventory.elements') }}" class="btn btn-sm btn-light btn-md py-0 float-right">
                    <b>Cancelar</b>
                </a>
           </div>
    </div>


@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection   
<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>