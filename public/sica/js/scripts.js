$(document).ready(function(){
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

    $(document).on("click", "#btnBuscarApprentices", function () {
      var miObjeto = new Object();
      miObjeto.course_id = $('#course_id').val();
      var myString = JSON.stringify(miObjeto);
      ajaxReplace('divApprentices','/sica/admin/people/apprentices/search',myString);     
    });


});