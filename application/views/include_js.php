
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url().'/assets/'?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url().'/assets/'?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url().'/assets/'?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Morris.js charts -->
<script src="<?=base_url().'/assets/'?>bower_components/raphael/raphael.min.js"></script>
<script src="<?=base_url().'/assets/'?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url().'/assets/'?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url().'/assets/'?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url().'/assets/'?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url().'/assets/'?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url().'/assets/'?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url().'/assets/'?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url().'/assets/'?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url().'/assets/'?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url().'/assets/'?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url().'/assets/'?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url().'/assets/'?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url().'/assets/'?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url().'/assets/'?>dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=base_url().'/assets/'?>plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url().'/assets/'?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url().'/assets/'?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  	$('.select2').select2()
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>