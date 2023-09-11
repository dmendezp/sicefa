@extends('agroindustria::layouts.master')
@section('content')
<div class="card">
    <form action="" method="">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="modal-body">
                        <label for="element" id="element" class="form-label">Elemento.</label>
                        <select class="form-select form-control" aria-label="Default select example"
                            name="category_id">
                            <option value="">Seleccione elemento</option>

                            @foreach ($elements as $element)
                                <option value="{{ $element->id }}">{{ $element->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-body">
                        <label for="category" id="category" class="form-label">Categoria.</label>
                        <select class="form-select form-control" aria-label="Default select example"
                            name="category_id">
                            <option value="">Seleccione Categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-body">
                        <label for="description" class="form-label">Descripcion.</label>
                        <input type="text" id="description" class="form-control"
                            aria-describedby="passwordHelpBlock">
                    </div>

                </div>
                <div class="col">
                    <div class="modal-body">
                        <label for="price" class="form-label">Precio.</label>
                        <input type="number" id="price" class="form-control"
                            aria-describedby="passwordHelpBlock">
                    </div>

                    <div class="modal-body">
                        <label for="stock" class="form-label">Disponible.</label>
                        <input type="number" id="stock" class="form-control"
                            aria-describedby="passwordHelpBlock">
                    </div>

                    <div class="modal-body">
                        <label for="expiration_date" class="form-label">Fecha de expiracion.</label>
                        <input type="date" id="expiration_date" class="form-control"
                            aria-describedby="passwordHelpBlock">
                    </div>
                </div>
            </div>
            <a  href="{{route('cefa.agroindustria.storer.create')}}" type="button" style=" width: 70px; height: 50px; margin-left: 1100px;" class="btn btn-success">Agregar</a>

        </div>

    </form>
</div>

@endsection