<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA ALAT
        <small>Data seluruh alat yang ada pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Inputkan seluruh data Alat (Kendaraan) yang ada pada perusahaan, hati-hati saat menghapus data alat.</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <a class="btn btn-primary btn-md" onclick="add_alat()"><i class="fa fa-plus"></i>&nbsp;Tambah Alat</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tableAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Alat</th>
                <th>Nama Alat</th>
                <th>Pemilik Alat</th>
                <th>Harga Alat Perjam</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- modeal begin ============================================== -->
  <div class="modal fade" id="modal-addAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formAddAlat">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Alat</label>
                <input name="nama_alat" type="text" class="form-control" placeholder="Nama Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Alat</label>
                <input name="kode_alat" type="text" class="form-control" placeholder="Kode Alat" required>
              </div>
              <div class="form-group">
                <label >Pemilik Alat</label>
                <select name="pemilik_alat" class="form-control select2" style="width: 100%;" required>
                  <option selected="selected" value="">pilih</option>
                  <?php
                    foreach ($pemilik_alat as $list) {
                  ?>
                    <option value="<?=$list->pemilik_id?>"><?=$list->kode_pemilik.' - '.$list->nama_pemilik?></option>
                  <?php } ?>
                </select>
                <i style="color: red;font-size: 12px;">Tambah pemilik alat pada menu Pemilik Alat</i>
              </div>
              <div class="form-group">
                <label>Harga Sewa Perjam</label>
                <input name="harga_sewa" type="number" class="form-control" placeholder="Harga Alat" required>
              </div>
              <div class="form-group">
                <label>Keterangan Tambahan</label>
                <input name="keterangan" type="text" class="form-control" placeholder="Keterangan exp NO Plat" required>
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

  <div class="modal fade" id="modal-editAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formEditAlat">
            <div class="box-body">
              <div class="form-group">
                <input name="alat_id_edit" type="hidden" value="">
              </div>
              <div class="form-group">
                <label>Nama Alat</label>
                <input name="nama_alat_edit" type="text" class="form-control" placeholder="Nama Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Alat</label>
                <input name="kode_alat_edit" type="text" class="form-control" placeholder="Kode Alat" required>
              </div>
              <div class="form-group">
                <label >Pemilik Alat</label>
                <select name="pemilik_alat_edit" class="form-control select2" style="width: 100%;" required>
                  <!-- <option selected="selected" value="">pilih</option> -->
                  <?php
                    foreach ($pemilik_alat as $list) {
                  ?>
                    <option id="editPemilik-<?=$list->pemilik_id?>" value="<?=$list->pemilik_id?>"><?=$list->kode_pemilik.' - '.$list->nama_pemilik?></option>
                  <?php } ?>
                </select>
                <i style="color: red;font-size: 12px;">Tambah pemilik alat pada menu Pemilik Alat</i>
              </div>
              <div class="form-group">
                <label>Harga Sewa Perjam</label>
                <input name="harga_sewa_edit" type="number" class="form-control" placeholder="Harga Alat" required>
              </div>
              <div class="form-group">
                <label>Keterangan Tambahan</label>
                <input name="keterangan_edit" type="text" class="form-control" placeholder="Keterangan exp NO Plat" required>
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

  <div class="modal modal-danger fade" id="modal-deleteAlat">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Alat</h4>
        </div>
        <div class="modal-body">
          <p><i class="fa fa-warning"></i> &nbsp;&nbsp;Anda Yakin Ingin Menghapus Data Alat Ini ? </p>
          <form role="form" id="formDeleteAlat">
            <div class="box-body">
              <div class="form-group">
                <input name="alat_id_delete" type="hidden" value="">
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
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tableAlat').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/alat/list')?>",
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
              $('#editPemilik-'+data.pemilik_id).attr('selected','selected');
              $('[name="harga_sewa_edit"]').val(data.harga_perjam);
              $('[name="keterangan_edit"]').val(data.keterangan);

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
        var keterangan = $('[name="keterangan"]').val();

        if (kode_alat == '' || nama_alat == '' || pemilik == '' || harga_sewa == '' || keterangan == ''){
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
        var keterangan = $('[name="keterangan_edit"]').val();

        if (kode_alat == '' || nama_alat == '' || pemilik == '' || harga_sewa == '' || keterangan == ''){
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
  </script>