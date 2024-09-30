<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables -->
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

<!-- Select2 -->
<script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- Script de tooltip de bootstrap 5  -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

<!-- Start Script Animate On Scroll  -->
<script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
<script>
    AOS.init();
</script>
<!-- End Sript Animate On Scroll  -->

{{--Script para traer el id del curso seleccionado--}}
<script>
    $(document).ready(function() {
        $('#course').change(function() {
            var selectedCourseId = $(this).val(); // Obtiene el ID del curso seleccionado
            console.log('ID del curso seleccionado:', selectedCourseId);
        });
    });
</script>

{{--Sweet alert para la solicitud--}}
<script>
    @if(Session::get('message_line'))
        @if (Session::get('icon') == 'success')
            swal({
                title: "{{trans('agroindustria::formulations.Success')}}",
                text: "{{ Session::get('message_line') }}",
                icon: "success",
            });
        @elseif (Session::get('icon') == 'error')
            swal({
                title: "Error!",
                text: "{{ Session::get('message_line') }}",
                icon: "error",
            });
        @endif
    @endif
</script>
 
 {{-- Busca productos segun el numero de documento --}}
<script>
    $(document).ready(function() {
        var baseUrl = '{{ route("agroindustria.instructor.units.element.name") }}';
          console.log(baseUrl);
          $('select[name="element[]"]').select2({
            placeholder: 'Seleccione un elemento',
            minimumInputLength: 3,
            ajax: {
                url: baseUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        element_id: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            }
          });

          // Manejar la selección de una persona en el campo de búsqueda
          $('.elementInventory-select').on('select2:select', function(e) {
              var selectedElement = e.params.data;
              console.log(selectedElement);
              // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
              $(this).closest('.elements').find('input.element_id').val(selectedElement.id);
              $(this).closest('.elements').find('input.element_name').val(selectedElement.text);
          });
        });
 </script>


<script>
    
    $(document).ready(function() {
        $('#activities').DataTable();
        $('#discharge').DataTable();
        $('#formulation').DataTable();
        $('#labors').DataTable();
        $('#request').DataTable();
        $('#table-production').DataTable();
        $('#request').DataTable();
        $('#deliveries').DataTable();
        $('#inventoryAlert').DataTable();
        $('#inventoryExp').DataTable();
        $('#deliveries').DataTable({
            "order": [[0, "desc"]], // Ordenar por la primera columna (Fecha de Solicitud) en orden descendente
            "paging": true,
            // Agrega otras opciones de configuración según tus necesidades
        });
    });
</script>