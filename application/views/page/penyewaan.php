<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PEMINJAMAN
        <small>Data seluruh penyewaan pada perusahaan</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data penyewaan merupakan data sluruh proses penyewaan alat yang terdapat pada perusahaan setiap harinya</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Table Penyewaan </b> </h4>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/penyewaan/add'?>" class="btn bg-purple btn-md" style="margin-top: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-plus"></i>&nbsp; Tambah Penyewaan</a>
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
          <div class="box-body table-responsive">
            <table id="tabelPenyewaan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Alat</th>
                <th>Tanggal</th>
                <th>Lama Pemakaian</th>
                <th>Penyewa</th>
                <th>Harga Perjam</th>
                <th>Total Biaya Sewa</th>
                <th>PPH</th>
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
            <h3 class="box-title">Form Penyewaan</h3>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/penyewaan'?>" class="btn btn-danger btn-md"><i class="fa fa-angle-left"></i>&nbsp; Kembali</a><br>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="<?php if (isset($data_edit)) { echo site_url('index.php/admin/penyewaan/update'); } else { echo site_url('index.php/admin/penyewaan/simpan'); }?>" class="form-horizontal">
            <div class="box-body">
              <input name="penyewaan_id" type="hidden" value="<?php if (isset($data_edit['penyewaan_id'])) echo $data_edit['penyewaan_id'];?>">
              <div class="form-group">
                <label class="col-md-2 control-label">Alat</label>
                <div class="col-md-10">
                  <select name="alat" class="form-control select2" style="width: 100%;" onchange="getHarga()" required>
                    <option value="">alat</option>
                    <?php
                      foreach ($alat as $list) {
                    ?>
                      <option value="<?=$list->alat_id?>" <?php if (isset($data_edit)) { if ($data_edit['alat_id'] == $list->alat_id) {echo 'selected';} }?>><?=$list->kode_alat.' - '.$list->nama_alat?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Penyewa</label>
                <div class="col-md-10">
                  <select name="client" type="number" class="form-control select2" id="exampleInputEmail1" placeholder="PPH dalam persen" required>
                  <option selected="selected" value="">Penyewa Alat</option>
                    <?php
                      foreach ($client as $list) {
                    ?>
                      <option value="<?=$list->client_id?>" <?php if (isset($data_edit)) { if ($data_edit['client_id'] == $list->client_id) {echo 'selected';} }?>><?=$list->kode_client.' - '.$list->nama_client?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Lama pemakaian</label>
                <div class="col-md-10">
                  <div class="input-group">
                    <input name="lama_pemakaian" type="text" class="form-control" value="<?php if (isset($data_edit['lama_pemakaian'])) echo $data_edit['lama_pemakaian'];?>" placeholder="lama Pemakaian dalam jam" required>
                    <div class="input-group-addon">
                      Jam
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga / jam</label>
                <div class="col-md-10">
                  <div class="input-group">
                    <input name="harga_pemakaian" type="number" class="form-control" value="<?php if (isset($data_edit['harga_perjam'])) echo $data_edit['harga_perjam'];?>" placeholder="Harga pemakaian perjam" required>
                    <div class="input-group-addon">
                      /Jam
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Penerima Dana</label>
                <div class="col-md-10">
                  <select name="penerima_dana" type="text" class="form-control" id="exampleInputEmail1" placeholder="Penerima dana penyewaan" required>
                    <option selected="selected" value="">Penerima dana</option>
                    <?php
                      foreach ($penyedia as $list) {
                    ?>
                      <option value="<?=$list->penyedia_id?>" <?php if (isset($data_edit)) { if ($data_edit['penyedia_id'] == $list->penyedia_id) {echo 'selected';} }?>><?=$list->kode_penyedia.' - '.$list->nama_penyedia?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Tgl Penerimaan Dana</label>
                <div class="col-md-10">
                  <input name="tgl_pemasukan" type="text" class="form-control datepicker" value="<?php if (isset($data_edit['tgl_pemasukan'])) echo $data_edit['tgl_pemasukan'];?>" placeholder="Tgl Pemasukan" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">PPH</label>
                <div class="col-md-10">
                  <div class="input-group">
                    <input name="pph" type="number" class="form-control" id="exampleInputEmail1" placeholder="PPH dalam persen" value="<?php if (isset($data_edit['pph'])) 
                    if($data_edit['pph'] == 0){
                      $a = 0;
                    } else{
                      $a=$data_edit['pph']/$data_edit['biaya_penyewaan']*100;
                    } 
                    echo $a;?>" required>
                    <div class="input-group-addon">
                       % 
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Potongan Fee</label>
                <div class="col-md-10">
                  <div class="input-group">
                    <input name="fee_operasional" type="number" class="form-control" id="exampleInputEmail1" placeholder="jumlah fee operasional perjam" value="<?php if (isset($data_edit['jumlah_fee'])) echo $data_edit['jumlah_fee'];?>" required>
                    <div class="input-group-addon">
                    /Jam
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
        table = $('#tabelPenyewaan').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/penyewaan/list')?>",
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

    function add_alat(){
        $('#formAddAlat')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-addAlat').modal('show'); // show bootstrap modal
    }

    function edit_alat(id){
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/admin/alat/edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="alat_id_edit"]').val(data.alat_id);
              $('[name="kode_alat_edit"]').val(data.kode_alat);
              $('[name="nama_alat_edit"]').val(data.nama_alat);
              $('#editPemilik-'+data.pemilikalat_id).attr('selected','selected');
              $('[name="harga_sewa_edit"]').val(data.harga_perjam);

              $('#modal-editAlat').modal('show'); // show bootstrap modal when complete loaded
              $('.select2').select2();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

    function delete_alat(step, id){
      if (step == 'ask'){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="alat_id_delete"]').val(id);
        $('#modal-deleteAlat').modal('show'); // show bootstrap modal
      }
    }

    function validation(form){
      if (form == 'add'){
        var kode_alat  = $('[name="kode_alat"]').val();
        var nama_alat  = $('[name="nama_alat"]').val();
        var pemilik    = $('[name="pemilik_alat"]').val();
        var harga_sewa = $('[name="harga_sewa"]').val();

        if (kode_alat == '' || nama_alat == '' || pemilik == '' || harga_sewa == ''){
          alert('tidak boleh ada fill yang kosong');
        }else{
          save('add');
        }
      }

      if (form == 'edit'){
        var kode_alat  = $('[name="kode_alat_edit"]').val();
        var nama_alat  = $('[name="nama_alat_edit"]').val();
        var pemilik    = $('[name="pemilik_alat_edit"]').val();
        var harga_sewa = $('[name="harga_sewa_edit"]').val();

        if (kode_alat == '' || nama_alat == '' || pemilik == '' || harga_sewa == ''){
          alert('tidak boleh ada fill yang kosong');
        }else{
          save('edit');
        }
      }
    }

    function save(form){
      var url;
      var idForm;
      var idModal;
      if (form == 'add'){
        url     = "<?=base_url().'index.php/admin/alat/add'?>";
        idForm  = 'formAddAlat';
        idModal = 'modal-addAlat';
      }
      if (form == 'edit'){
        url     = "<?=base_url().'index.php/admin/alat/update'?>";
        idForm  = 'formEditAlat';
        idModal = 'modal-editAlat';
      }
      if (form == 'delete'){
        url     = "<?=base_url().'index.php/admin/alat/delete'?>";
        idForm  = 'formDeleteAlat';
        idModal = 'modal-deleteAlat';
      }

      $.ajax({
          url : url,
          type: "POST",
          data: $('#'+idForm).serialize(),
          dataType: "JSON",
          success: function(data)
          {

              if(data.status) //if success close modal and reload ajax table
              {
                  $('#'+idModal).modal('hide');
                  reload_table();
              }

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
    }

    function getHarga(){
      var alatId = $('[name="alat"]').val();
      if (alatId != ''){
        $.ajax({
            url : "<?=base_url().'index.php/admin/penyewaan/gethargaalat/'?>"+alatId,
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
  </script>