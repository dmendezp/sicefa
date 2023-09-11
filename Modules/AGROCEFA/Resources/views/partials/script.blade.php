
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>

<script src="{{ asset('agrocefa/js/sidebarclose.js')}}"></script>


<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
  });
  </script>
  <script>
    $(document).ready(function () {
            // Función para cargar y mostrar los datos filtrados
            function loadFilteredData(startDate, endDate) {
                $.ajax({
                    url: "{{ route('agrocefa.reports.filterByDate') }}",
                    type: "POST",
                    data: {
                        startDate: startDate,
                        endDate: endDate,
                    },
                    success: function (data) {
                        // Limpia el cuerpo de la tabla
                        $("#tableBody").empty();

                        // Recorre los datos recibidos y agrega filas a la tabla
                        $.each(data, function (index, item) {
                            var row = $("<tr>").append(
                                $("<td>").text(item.consumableId),
                                $("<td>").text(item.laborDate),
                                $("<td>").text(item.laborDescription),
                                $("<td>").text(item.elementName),
                                $("<td>").text(item.consumableAmount),
                                $("<td>").text(item.consumablePrice)
                                // Agrega más columnas según tus datos
                            );
                            $("#tableBody").append(row);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            }

            // Manejador de eventos para el botón de filtro
            $("#filterButton").click(function () {
                var startDate = $("#startDate").val();
                var endDate = $("#endDate").val();

                // Verifica que las fechas sean válidas antes de enviar la solicitud
                if (startDate && endDate) {
                    loadFilteredData(startDate, endDate);
                } else {
                    alert("Por favor, selecciona ambas fechas.");
                }
            });
        });
  </script>