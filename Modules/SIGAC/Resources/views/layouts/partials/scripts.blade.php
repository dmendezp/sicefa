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

<!-- Script de Fullcalendar  -->
<script src='{{ asset('libs/fullcalendar-6.1.8/dist/index.global.min.js') }}'></script>

