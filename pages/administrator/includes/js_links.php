<!-- REQUIRED SCRIPTS -->

<!-- Pooper -->
<script src="../../plugins/bootstrap/js/popper.min.js"></script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/dataTables.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.min.js"></script>

<!-- Input Mask -->
<script src="../../plugins/inputmask/inputmask.min.js"></script>

<!-- Export to exel -->
<script src="../../plugins/export-to-excel/tableHTMLExport.js"></script>

<!-- Initilize Select2 -->
<script type="text/javascript">
$(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    $('.datatable').DataTable();
    
    $(":input").inputmask();

  	$('.title').tooltip({
  		trigger : 'hover'
  	});

  	$("#preloader").fadeOut("fast");
  	// document.addEventListener('contextmenu', function(e) {
   //    e.preventDefault();
   //  });
});


</script>