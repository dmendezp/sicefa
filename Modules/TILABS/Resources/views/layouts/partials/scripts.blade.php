<!-- Jquery -->
<script src="{{ asset('libs/jquery-3.6.4.min.js') }}"></script>
<!-- General Scripts -->
<script src="{{ asset('js/generalscripts.js') }}"></script>
<script src="{{ asset('modules/tilabs/js/scripts.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- Boostrap-5.3.0 -->
<script src="{{ asset('libs/Bootstrap-5.3.0-alpha/js/bootstrap.bundle.min.js')}}"></script>
<!-- Boostrap-enable-tooltip-->
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
<!-- Sweetalet2 -->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>