@extends('agroindustria::layouts.master')
@include('agroindustria::layouts.partials.head')

@section('content')
<center>
    <div class="container-fluid">
        <div class="card" style="width:1100px" >
        <table id="example" class="hover">
            <br>
            <center>    <h1>Inventario</h1>
                </center>
                
            <a href="" style="width: 50px; height: 40px; margin-left: 1030px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"    ><i style="margin-top: 12px;" class="fa-solid fa-plus fa-sm"></i></a>
            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Insumos.</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                            <div class="modal-body">
                                <div class="container text-center">
                                    <form action="{{ route('cefa.agroindustria.storer.create') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Elemento.</label>
                                                    <select class="form-select" name="element_id" aria-label="Default select example">
                                                        <option selected>Seleccione elemento</option>
                                                        @foreach($elements as $element)
                                                            <option value="{{ $element->id }}">{{ $element->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            
                                              
                                                @foreach ( $inventories as $inventory)
                                                <input type="hidden" name="productive_unit_warehouse_id" value="{{ $inventory->productive_unit_warehouse_id}}">                                            
                                                <input type="hidden" name="person_id" value="2">     
                                                                                           
                                                @endforeach
        
                                                <div class="mb-3">
                                                    <label class="form-label">Descripcion.</label>
                                                    <input type="text" class="form-control" name="description" placeholder="Ingrese Descripcion.">
                                                </div>
                                    
                                                <div class="mb-3">
                                                    <label class="form-label">Categoria.</label>
                                                    <select class="form-select" name="category_id" aria-label="Default select example">
                                                        <option selected>Seleccione Categoria</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Precio.   </label>
                                                    <input type="number" class="form-control" name="price" placeholder="Ingrese Precio.">
                                                </div>
                                    
                                                <div class="mb-3">
                                                    <label class="form-label">Disponible.</label>
                                                    <input type="number" class="form-control" name="stock" placeholder="Ingrese cantidad disponible.">
                                                </div>
                                    
                                                <div class="mb-3">
                                                    <label class="form-label">Fecha de expiracion.</label>
                                                    <input type="date" class="form-control" name="expiration_date" placeholder="Seleccione Fecha de vencimiento.">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    
                                    
                                </div>
                            </div>
                    
                </div>
            </div>
          </div>
        
        
            <br>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th>Fecha de expiracion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $inventories as $inventory)
                    <tr>
                        <td>{{$inventory->id}}</td>
                        <td>{{$inventory->element->name}}</td>
                        <td>{{$inventory->description}}</td>
                        <td>{{$inventory->element->category->name}}</td>
                        <td>{{$inventory->price}}</td>
                        <td>{{$inventory->stock}}</td>
                        <td>{{$inventory->expiration_date}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Editar</button>
                            |
                            <button type="button" class="btn btn-primary">Eliminar</button>
                        </td>
                    </tr>
                    
                    @endforeach
                    </tbody>
                
            </table>
        </div>  
        </div>
</center>

    
@section('script')
@endsection

@endsection
