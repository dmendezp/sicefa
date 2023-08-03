@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">

      QUARTERS
      <div id='calendar'>
      </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <fieldset class="form-group">
            <label for="title">Titulo</label>
            <input type="text" class="form-control" id="title" placeholder="">
          </fieldset>
          <fieldset class="form-group">
            <label for="description">Descripción</label>
            <input type="text" class="form-control" id="description" placeholder="">
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:"es",
          headerToolbar:{
            left:'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
          }

        });
        calendar.render();
      });

      $(document).on('click', '#calendar', function () {
        $('#exampleModal').modal('show');
      });
</script>    
@endsection