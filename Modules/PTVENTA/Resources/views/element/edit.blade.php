@extends('ptventa::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.admin.element.index') }}" class="text-decoration-none">Inicio</a></li>
    <li class="breadcrumb-item active">Productos</li>
    <li class="breadcrumb-item active">Actualizar imagen</li>
@endsection

<style type="text/css">
    body{
        background:#f6d352; 
    }
    h1{
        font-weight: bold;
        font-size:23px;
    }
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        text-align: center;
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    input{
        margin-top:40px;
    }
    .section{
        margin-top:150px;
        background:#fff;
        padding:50px 30px;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>

@section('content')
    <form action="{{ route('ptventa.admin.element.update', $element) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-success card-outline col-10 mx-auto">

            <div class="card-body pb-0">
                <div class="row">

                    <div class="col-7">
                        <div class="card card-success border-success">
                            <div class="card-header text-center h5 py-1">
                                Imagen
                            </div>
                            <div class="card-body mx-auto">
                                <img src="{{ asset($element->image) }}" id="selected_image" class="img-fluid img-thumbnail" style="max-height: 400px; max-width: 600px">
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Producto</label>
                            <p class="form-control text-secondary">
                                {{ $element->name }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <p class="form-control text-secondary">
                                $ 3.000
                            </p>
                        </div>
                        <br><hr>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Seleccionar imagen</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer bg-white text-right">
                <a href="{{ route('ptventa.admin.element.index') }}" class="btn btn-sm btn-light mr-2">
                    <b>Cancelar</b>
                </a>
                <button type="submit" class="btn btn-sm btn-success">
                    <b>Actualizar</b>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#selected_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result; 
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "crop-image-upload-ajax",
                        data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                        success: function(data){
                            console.log(data);
                            $modal.modal('hide');
                            alert("Crop image successfully uploaded");
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

@endsection
