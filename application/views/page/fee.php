<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA FEE OPERASIONAL
        <small>Data seluruh fee operasional pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Fee merupakan data Debit dan Credit saat adanya transaksi penyewaan alat</p>
      </div>
      <?php if ($this->session->flashdata('statuserror')) { ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Gagal!</h4>
          <?=$this->session->flashdata('statuserror');?>
        </div>
      <?php } ?>
      <?php if ($this->session->flashdata('statussucccess')) { ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Berhasil!</h4>
          <?=$this->session->flashdata('statussucccess');?>
        </div>
      <?php } ?>
      <!-- =========================== end allert and note =========================== -->

      <?php if ($view == 'data') { ?>
        <!-- ========================== layout data table ============================ -->
        <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Table Fee Operasional</b> </h4>
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
            <table id="tableFee" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th>No</th>
                <th>Tgl Fee</th>
                <th>Jenis Fee</th>
                <th>Jenis Biaya</th>
                <th>Jumlah</th>
                <th>Penanggung Jawab</th>
              </tr>
              </thead>
              <tbody>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- ============================ end layout data ============================ -->
      <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tableFee').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/fee/list')?>",
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

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
  </script>