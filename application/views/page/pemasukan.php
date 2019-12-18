<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PEMASUKAN
        <small>Data seluruh pemasukan pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <?php if ($view == 'data') { ?>
        <!-- ========================== layout data table ============================ -->
        <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Table Pemasukan </b> </h4>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <style type="text/css">
            .left{
              text-align: left;
              float:left;
              width:20%;
            }
            .right{
              text-align: right;
              float:right;
              width:80%;
            }
          </style>
          <div class="box-body">
            <table id="tablePemasukan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tgl Pemasukan</th>
                <th>Alat</th>
                <th>Pemasukan Setelah PPH</th>
                <th>Penerima Dana</th>
              </tr>
              </thead>
              <tbody>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tablePemasukan').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/pemasukan/list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ -1,0 ], //last column
                "orderable": false, //set not orderable
            },
            ],

        });

        $('.datepicker').datepicker({format: 'yyyy/mm/dd' });
        $('.select2').select2();
    });
  </script>