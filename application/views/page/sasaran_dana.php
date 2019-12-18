<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA JENIS BIAYA
        <small>Data seluruh jenis biaya</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Jenis Biaya adalah data untuk identifikasi tujuan penggunaan dana</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <a class="btn btn-primary btn-md" onclick="add_sasarandana()"><i class="fa fa-plus"></i>&nbsp;Tambah Jenis Biaya</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tableSasaranDana" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Biaya</th>
                <th>Jenis Biaya</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 0; foreach ($sasaran_dana as $list) { $no++;?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$list->kode_sasaran?></td>
                  <td><?=$list->sasaran?></td>
                  <td>
                  	<div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="javascript:void(0)" onclick="edit_sasarandana('<?=$list->sasarandana_id?>')">
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Hapus" onclick="delete_sasarandana('ask',<?=$list->sasarandana_id?>)">
                                    <i class="fa fa-trash"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- modeal begin ============================================== -->
  <div class="modal fade" id="modal-addSasaranDana">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Jenis Biaya</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formaddSasaranDana">
            <div class="box-body">
              <div class="form-group">
                <label>Kode</label>
                <input name="kode_sasaran" type="text" class="form-control" placeholder="Kode Jenis Biaya max-8 karakter" maxlength="8" required>
              </div>
              <div class="form-group">
                <label>Jenis Biaya</label>
                <input name="sasaran" type="text" class="form-control" placeholder="Jenis Biaya (contoh 'SPARE PART')" required>
              </div>
            </div>  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" onclick="validation('add')" class="btn btn-primary">Simpan Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-editSasaranDana">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Jenis Biaya</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formeditSasaranDana">
            <div class="box-body">
                <div class="form-group">
                  <input name="sasarandana_id_edit" type="hidden">
                </div>
                <div class="form-group">
                  <label>Kode</label>
                  <input name="kode_sasaran_edit" type="text" class="form-control" placeholder="Kode Jenis Biaya max-8 karakter" maxlength="8" required>
                </div>
                <div class="form-group">
                  <label>Jenis Biaya</label>
                  <input name="sasaran_edit" type="text" class="form-control" placeholder="Jenis Biaya (contoh 'SPARE PART')" required>
                </div>
              </div> 
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" onclick="validation('edit')" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>

  <div class="modal modal-danger fade" id="modal-deleteSasaranDana">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Jenis Biaya</h4>
        </div>
        <div class="modal-body">
          <p><i class="fa fa-warning"></i> &nbsp;&nbsp;Anda Yakin Ingin Menghapus Data Ini ? </p>
          <form role="form" id="formdeleteSasaranDana">
            <div class="box-body">
              <div class="form-group">
                <input name="sasarandana_id_delete" type="hidden" value="">
              </div>
            </div>  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
          <button type="button" onclick="save('delete')" class="btn btn-outline">Hapus</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- /.modal -->
  <script>
	$(function () {
		$('#tableSasaranDana').DataTable()
	})
    var table;

    function add_sasarandana(){
        $('#formaddSasaranDana')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-addSasaranDana').modal('show'); // show bootstrap modal
    }

    function edit_sasarandana(id){
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/admin/sasaran_dana/edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="sasarandana_id_edit"]').val(data.sasarandana_id);
              $('[name="sasaran_edit"]').val(data.sasaran);
              $('[name="kode_sasaran_edit"]').val(data.kode_sasaran);

              $('#modal-editSasaranDana').modal('show'); // show bootstrap modal when complete loaded
              $('.select2').select2();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

    function delete_sasarandana(step, id){
      if (step == 'ask'){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="sasarandana_id_delete"]').val(id);
        $('#modal-deleteSasaranDana').modal('show'); // show bootstrap modal
      }
    }

    function validation(form){
      if (form == 'add'){
        var sasaran_dana   = $('[name="sasaran"]').val();
        var kode_sasaran   = $('[name="kode_sasaran"]').val();

        if (sasaran_dana == '' || kode_sasaran == ''){
          alert('tidak boleh ada fill yang kosong');
        }else{
          save('add');
        }
      }

      if (form == 'edit'){
        var sasaran_dana   = $('[name="sasaran_edit"]').val();
        var kode_sasaran   = $('[name="kode_sasaran_edit"]').val();

        if (sasaran_dana == '' || kode_sasaran == ''){
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
        url     = "<?=base_url().'index.php/admin/sasaran_dana/add'?>";
        idForm  = 'formaddSasaranDana';
        idModal = 'modal-addSasaranDana';
      }
      if (form == 'edit'){
        url     = "<?=base_url().'index.php/admin/sasaran_dana/update'?>";
        idForm  = 'formeditSasaranDana';
        idModal = 'modal-editSasaranDana';
      }
      if (form == 'delete'){
        url     = "<?=base_url().'index.php/admin/sasaran_dana/delete'?>";
        idForm  = 'formdeleteSasaranDana';
        idModal = 'modal-deleteSasaranDana';
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
                  location.reload();
              }

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
    }
  </script>