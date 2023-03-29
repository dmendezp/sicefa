@extends('ganaderia::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0"></h3>
            </div>
            <div class="card-body">
              <form method="post" action="#" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-start">

                  <div class="col">
                    <div class="form-group">
                      <label for="name">Codigo </label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                  </div>


                  <div class="col">
                    <div class="form-group">
                      <label for="name">Codigo </label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label for="page">Madre </label>
                      <select class="form-control" name="page" id="page">
                        @foreach($page as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="content">{{ trans('ganaderia::page.Content') }}</label>
                    <input type="text" class="form-control" name="content" id="content">
                  </div>

                  

                  
                  <div class="d-grip gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-success btn-lg">{{ trans('ganaderia::page.save') }} {{ trans('ganaderia:page') }}</button>
                  </div>
                

                
                  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





@endsection