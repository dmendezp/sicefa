<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>sesta seguro de elimnar el registro</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'cefa.agroindustria.storer.destroy', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            @foreach ($inventories as $inventory)
            {!! Form::hidden('id', $inventory->id) !!}
           
            <div class="row">
                <div class="col-6 text-right"><b>ID{{-- {{trans('sica::menu.Code')}} --}} </b></div>
                <div class="col">{{ $inventory->id }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Name')}}</b></div>
                <div class="col">{{$inventory->element->name}}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Category')}}</b></div>
                <div class="col">{{$inventory->element->category->name}}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Description')}}</b></div>
                <div class="col">{{$inventory->description}}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Price')}}</b></div>
                <div class="col">{{$inventory->price}}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Stock')}}</b></div>
                <div class="col">{{$inventory->stock}}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>{{trans('agroindustria::menu.Expiration Date')}} </b></div>
                <div class="col">{{$inventory->expiration_date}}</div>
            </div>
        </div>
                
            @endforeach
           
        <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">{{trans('sica::menu.Cancel')}}</button>
                {!! Form::submit(trans('sica::menu.Delete'), ['class'=>'btn btn-danger btn-md py-0']) !!}
        </div>
    {!! Form::close() !!}
</div>