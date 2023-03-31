@extends('ganaderia::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">Unidad Productiva</h3>
            </div>
            <div class="card-body">
              <div class="content">
<form>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Actividad</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
      
      <div class="form-group">
<label>Fecha:</label>
<div class="input-group date" id="reservationdate" data-target-input="nearest">
<input type="date" class="form-control datetimepicker-input" data-target="#reservationdate">
</div>
</div>
    
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Consumo</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>


   
    <div class="form-group">
      <label for="exampleTextarea" class="form-label mt-4">Example textarea</label>
      <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
    
     
  </fieldset>
</form>
@endsection
