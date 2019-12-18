<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA TOKO
        <small>Data seluruh toko penyedia barang keperluan alat</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Toko ALat ini berguna untuk merecord seluruh toko /  supplier tempat penyedia jasa melakuakn pembelian barang kebutuhan operasional alat</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <a class="btn btn-primary btn-md" onclick="add_toko()"><i class="fa fa-plus"></i>&nbsp;Tambah Toko</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tableToko" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Toko</th>
                <th>Nama Toko</th>
                <th>Alamat Toko</th>
                <th>Kontak Toko</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 0; foreach ($toko as $list) { $no++;?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$list->kode_toko?></td>
                  <td><?=$list->nama_toko?></td>
                  <td><?=$list->alamat_toko?></td>
                  <td><?=$list->kontak_toko?></td>
                  <td>
                  	<div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a title="Edit" href="javascript:void(0)" onclick="edit_toko('<?=$list->toko_id?>')">
                                    <i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Hapus" onclick="delete_toko('ask',<?=$list->toko_id?>)">
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
  <div class="modal fade" id="modal-addToko">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Toko</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formaddToko">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Toko</label>
                <input name="nama_toko" type="text" class="form-control" placeholder="Nama Toko" required>
              </div>
              <div class="form-group">
                <label>Kode Toko</label>
                <input name="kode_toko" type="text" class="form-control" placeholder="Kode Toko" required>
              </div>
              <div class="form-group">
                <label>Alamat Toko</label>
                <input name="alamat_toko" type="text" class="form-control" placeholder="Alamat Toko" required>
              </div>
              <div class="form-group">
                <label>Kontak Toko</label>
                <input name="kontak_toko" type="text" class="form-control" placeholder="Kontak Toko" required>
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

  <div class="modal fade" id="modal-editToko">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formeditToko">
            <div class="box-body">
            <div class="form-group">
                <input name="toko_id_edit" type="hidden">
              </div>
              <div class="form-group">
                <label>Nama Pemakai</label>
                <input name="nama_toko_edit" type="text" class="form-control" placeholder="Nama Toko" required>
              </div>
              <div class="form-group">
                <label>Kode Pemakai</label>
                <input name="kode_toko_edit" type="text" class="form-control" placeholder="Kode Toko" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input name="alamat_toko_edit" type="text" class="form-control" placeholder="Alamat Toko" required>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input name="kontak_toko_edit" type="text" class="form-control" placeholder="Kontak Toko" required>
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

  <div class="modal modal-danger fade" id="modal-deleteToko">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Toko</h4>
        </div>
        <div class="modal-body">
          <p><i class="fa fa-warning"></i> &nbsp;&nbsp;Anda Yakin Ingin Menghapus Data Toko Ini ? </p>
          <form role="form" id="formdeleteToko">
            <div class="box-body">
              <div class="form-group">
                <input name="toko_id_delete" type="hidden" value="">
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
		$('#tableToko').DataTable()
	})
    var table;

    function add_toko(){
        $('#formaddToko')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-addToko').modal('show'); // show bootstrap modal
    }

    function edit_toko(id){
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/admin/toko/edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="toko_id_edit"]').val(data.toko_id);
              $('[name="nama_toko_edit"]').val(data.nama_toko);
              $('[name="kode_toko_edit"]').val(data.kode_toko);
              $('[name="alamat_toko_edit"]').val(data.alamat_toko);
              $('[name="kontak_toko_edit"]').val(data.kontak_toko);

              $('#modal-editToko').modal('show'); // show bootstrap modal when complete loaded
              $('.select2').select2();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

    function delete_toko(step, id){
      if (step == 'ask'){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="toko_id_delete"]').val(id);
        $('#modal-deleteToko').modal('show'); // show bootstrap modal
      }
    }

    function validation(form){
      if (form == 'add'){
        var nama_toko   = $('[name="nama_toko"]').val();
        var kode_toko   = $('[name="kode_toko"]').val();
        var alamat_toko  = $('[name="alamat_toko"]').val();
        var kontak_toko = $('[name="kontak_toko"]').val();

        if (nama_toko == '' || kode_toko == '' || alamat_toko == '' || kontak_toko == ''){
          alert('tidak boleh ada fill yang kosong');
        }else{
          save('add');
        }
      }

      if (form == 'edit'){
        var nama_pemilik_edit   = $('[name="nama_pemilik_edit"]').val();
        var kode_pemilik_edit   = $('[name="kode_pemilik_edit"]').val();
        var kontak_pemilik_edit = $('[name="kontak_pemilik_edit"]').val();
        var kontak_pemilik_edit = $('[name="kontak_pemilik_edit"]').val();

        if (nama_pemilik_edit == '' || kode_pemilik_edit == '' || kontak_pemilik_edit == ''){
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
        url     = "<?=base_url().'index.php/admin/toko/add'?>";
        idForm  = 'formaddToko';
        idModal = 'modal-addToko';
      }
      if (form == 'edit'){
        url     = "<?=base_url().'index.php/admin/toko/update'?>";
        idForm  = 'formeditToko';
        idModal = 'modal-editToko';
      }
      if (form == 'delete'){
        url     = "<?=base_url().'index.php/admin/toko/delete'?>";
        idForm  = 'formdeleteToko';
        idModal = 'modal-deleteToko';
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