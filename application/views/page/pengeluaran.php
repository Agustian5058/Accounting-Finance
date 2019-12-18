<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PENGELUARAN
        <small>Data seluruh pengeluaran pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Pengeluaran Ini berfungsi untuk merecord pengeluaran perusahaan</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Table Pengeluaran </b> </h4>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/pengeluaran/add'?>" class="btn bg-purple btn-md" style="margin-top: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-plus"></i>&nbsp; Tambah Pengeluaran</a>
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
          <div class="col-md-12">
            <center>
              <div class="col-md-5"></div><div class="col-md-2"><?=$total?></div>
            </center>
          </div>
          <div class="box-body table-responsive">
            <table id="tableAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tgl Pengeluaran</th>
                <th>No Voucher</th>
                <th>Kode Biaya</th>
                <th>Alat</th>
                <th>Rincian</th>
                <th>Jumlah</th>
                <th>Dana</th>
                <th>Action</th>
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
      <?php if ($view == 'form') { ?>
        <!-- ============================== layout form ============================== -->
        <!-- form input -->
        <div class="box box-primary">
          <div class="box-header with-border" style="padding-bottom: 20px;">
            <h3 class="box-title">Form Pengeluaran</h3>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/pengeluaran'?>" class="btn btn-danger btn-md"><i class="fa fa-angle-left"></i>&nbsp; Kembali</a><br>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="<?php if (isset($data_edit)) { echo site_url('index.php/admin/pengeluaran/update'); } else { echo site_url('index.php/admin/pengeluaran/simpan'); }?>" class="form-horizontal">
            <div class="box-body">
              <input name="pengeluaran_id" type="hidden" value="<?php if (isset($data_edit['pengeluaran_id'])) echo $data_edit['pengeluaran_id'];?>">
              <div class="col-md-4 bg-gray">
                <br>
                <div class="form-group">
                  <label class="col-md-5 control-label">Sumber Dana</label>
                  <div class="col-md-7">
                    <select name="sumber_dana" class="form-control" onchange="getTanggungan()" required>
                      <option value="">- sumber dana -</option>
                      <option value="dana alat" <?php if (isset($data_edit)){ if ($data_edit['sumber_dana']=='dana alat') echo 'selected'; }?>>Dana Alat</option>
                      <option value="dana fee" <?php if (isset($data_edit)){ if ($data_edit['sumber_dana']=='dana fee') echo 'selected'; }?>>Dana Fee</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Tanggungan</label>
                  <div class="col-md-7">
                    <select name="penanggung_jawab" class="form-control" id="optionTanggungan" required>
                      <?php if (isset($data_edit)){ ?>
                        <option value="<?=$data_edit['penanggung_jawab']?>" selected><?=$data_edit['penanggung_jawab']?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Kode Voucher</label>
                  <div class="col-md-7">
                    <input type="text" name="kode_voucher" class="form-control" placeholder="kode voucher" value="<?php if (isset($data_edit)){ echo $data_edit['kode_voucher']; }?>" required>
                  </div>
                </div>

                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-warning"></i> Info !</h4>
                  <div style="font-size: 10px;">
                    SUMBER DANA : Dana yang akan digunakan untuk pengeluaran<br>
                    TANGGUNGAN  : Yang mengeluarkan dana pengeluaran<br>
                    K. VOUCHER  : No Akun Perusahaan
                  </div>
                </div>
              </div>
              
              <div class="col-md-8">
                <br>
                <div class="form-group">
                  <label class="col-md-4 control-label">Tgl Pengeluaran</label>
                  <div class="col-md-8">
                    <input name="tgl_pengeluaran" type="text" class="form-control datepicker" value="<?php if (isset($data_edit['tgl_pengeluaran'])) echo $data_edit['tgl_pengeluaran'];?>" placeholder="Tgl Pengeluaran" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Jenis Biaya</label>
                  <div class="col-md-8">
                    <select name="jenis_biaya" class="form-control select2" style="width: 100%;"  required>
                      <option value="">-- jenis biaya --</option>
                      <?php
                        foreach ($jenis_biaya as $list) {
                      ?>
                        <option value="<?=$list->sasarandana_id?>" <?php if (isset($data_edit)) { if ($data_edit['jenis_biaya'] == $list->sasarandana_id) {echo 'selected';} }?>><?='['.$list->kode_sasaran.'] - '.$list->sasaran?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Rincian</label>
                  <div class="col-md-8">
                    <textarea name="rincian" type="text" class="form-control" placeholder="Rincian Pengeluaran" required><?php if (isset($data_edit['rincian'])) echo $data_edit['rincian'];?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Untuk Alat</label>
                  <div class="col-md-8">
                    <select name="alat" class="form-control select2" style="width: 100%;" >
                      <option value="">-- alat --</option>
                      <?php
                        foreach ($alat as $list) {
                      ?>
                        <option value="<?=$list->alat_id?>" <?php if (isset($data_edit)) { if ($data_edit['alat'] == $list->alat_id) {echo 'selected';} }?>><?=$list->kode_alat.' - '.$list->nama_alat?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Toko</label>
                  <div class="col-md-8">
                    <select name="toko" class="form-control select2" style="width: 100%;" >
                      <option value="">-- toko --</option>
                      <?php
                        foreach ($toko as $list) {
                      ?>
                        <option value="<?=$list->toko_id?>" <?php if (isset($data_edit)) { if ($data_edit['toko'] == $list->toko_id) {echo 'selected';} }?>><?='['.$list->kode_toko.'] - '.$list->nama_toko?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Total Pegeluaran</label>
                  <div class="col-md-8">
                    <div class="input-group">
                      <input name="pengeluaran" type="number" class="form-control" value="<?php if (isset($data_edit['pengeluaran'])) echo $data_edit['pengeluaran'];?>" placeholder="Total Pengeluaran" required>
                      <div class="input-group-addon">
                        Rupiah
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="reset" class="btn btn-default pull-left">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
        <!-- ============================= end layout form ========================= -->
      <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tableAlat').DataTable({ 

            "processing": false, //Feature control the processing indicator.
            "serverSide": false, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/pengeluaran/list/1')?>",
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

    $('#pageCount').on('change', function(e){
      // console.log(this.value)
      table.destroy();
      table = $('#tableAlat').DataTable({ 

            "processing": false, //Feature control the processing indicator.
            "serverSide": false, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/pengeluaran/list/')?>"+this.value,
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
    });

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function getHarga(){
      var alatId = $('[name="alat"]').val();
      if (alatId != ''){
        $.ajax({
            url : "<?=base_url().'index.php/admin/pengeluaran/gethargaalat/'?>"+alatId,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               $('[name="harga_pemakaian"]').val(data.harga);
            }
        });
      }else{
        $('[name="harga_pemakaian"]').val('');
      }
    }

    function getTanggungan(){
      var sumber = $('[name="sumber_dana"]').val();
      if (sumber == 'dana alat'){
        $//('[name="alat"]').attr('required','required');
        var option = $('#optionTanggungan');
        option.children().remove();
        option.append('<option value="AHONG">AHONG</option>');
        option.append('<option value="MJA">MJA</option>');
        option.append('<option value="PEMILIK">PEMILIK</option>');
      }
      else if (sumber == 'dana fee'){
        var option = $('#optionTanggungan');
        option.children().remove();
        option.append('<option value="AHONG">AHONG</option>');
        option.append('<option value="MJA">MJA</option>');
      }else{
        var option = $('#optionTanggungan');
        option.children().remove();
      }
    }
  </script>