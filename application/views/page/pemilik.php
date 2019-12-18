<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PEMILIK ALAT
        <small>Data seluruh pemilik alat yang ada pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Pemilik alat adalah data penanggung jawab setiap alat yang ada pada perusahaan. saat in ihanya untuk MJA DAN AHONG</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <a class="btn btn-primary btn-md" onclick="add_pemilikalat()"><i class="fa fa-plus"></i>&nbsp;Tambah Pemilik Alat</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tablePemilikAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Pemilik</th>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Kontak</th>
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
  <div class="modal fade" id="modal-addPemilikAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Pemilik Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formAddPemilikAlat">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Pemilik</label>
                <input name="nama_pemilik" type="text" class="form-control" placeholder="Nama Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Pemilik</label>
                <input name="kode_pemilik" type="text" class="form-control" placeholder="Kode Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input name="alamat_pemilik" type="text" class="form-control" placeholder="Alamat Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input name="kontak_pemilik" type="text" class="form-control" placeholder="Kontak Pemilik Alat" required>
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

  <div class="modal fade" id="modal-editPemilikAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formEditPemilikAlat">
            <div class="box-body">
            <div class="form-group">
                <input name="pemilikalat_id_edit" type="hidden">
              </div>
              <div class="form-group">
                <label>Nama Pemilik</label>
                <input name="nama_pemilik_edit" type="text" class="form-control" placeholder="Nama Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Pemilik</label>
                <input name="kode_pemilik_edit" type="text" class="form-control" placeholder="Kode Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input name="alamat_pemilik_edit" type="text" class="form-control" placeholder="Alamat Pemilik Alat" required>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input name="kontak_pemilik_edit" type="text" class="form-control" placeholder="Kontak Pemilik Alat" required>
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

  <div class="modal modal-danger fade" id="modal-deletePemilikAlat">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Pemilik Alat</h4>
        </div>
        <div class="modal-body">
          <p><i class="fa fa-warning"></i> &nbsp;&nbsp;Anda Yakin Ingin Menghapus Data  Ini ? </p>
          <form role="form" id="formDeletePemilikAlat">
            <div class="box-body">
              <div class="form-group">
                <input name="pemilikalat_id_delete" type="hidden" value="">
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
        table = $('#tablePemilikAlat').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/pemilik/list')?>",
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

    function add_pemilikalat(){
        $('#formAddPemilikAlat')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-addPemilikAlat').modal('show'); // show bootstrap modal
    }

    function edit_pemilikalat(id){
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/admin/pemilik/edit')?>/" + id,
          url : "<?php echo site_url('index.php/admin/pemilik/edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="pemilikalat_id_edit"]').val(data.pemilik_id);
              $('[name="nama_pemilik_edit"]').val(data.nama_pemilik);
              $('[name="kode_pemilik_edit"]').val(data.kode_pemilik);
              $('[name="alamat_pemilik_edit"]').val(data.alamat_pemilik);
              $('[name="kontak_pemilik_edit"]').val(data.kontak_pemilik);

              $('#modal-editPemilikAlat').modal('show'); // show bootstrap modal when complete loaded
              $('.select2').select2();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

    function delete_pemilikalat(step, id){
      if (step == 'ask'){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="pemilikalat_id_delete"]').val(id);
        $('#modal-deletePemilikAlat').modal('show'); // show bootstrap modal
      }
    }

    function validation(form){
      if (form == 'add'){
        var nama_pemilik   = $('[name="nama_pemilik"]').val();
        var kode_pemilik   = $('[name="kode_pemilik"]').val();
        var alamat_pemilik = $('[name="alamat_pemilik"]').val();
        var kontak_pemilik = $('[name="kontak_pemilik"]').val();

        if (nama_pemilik == '' || kode_pemilik == '' || kontak_pemilik == '' || alamat_pemilik == ''){
          alert('tidak boleh ada fill yang kosong');
        }else{
          save('add');
        }
      }

      if (form == 'edit'){
        var nama_pemilik_edit   = $('[name="nama_pemilik_edit"]').val();
        var kode_pemilik_edit   = $('[name="kode_pemilik_edit"]').val();
        var alamat_pemilik      = $('[name="alamat_pemilik_edit"]').val();
        var kontak_pemilik_edit = $('[name="kontak_pemilik_edit"]').val();

        if (nama_pemilik_edit == '' || kode_pemilik_edit == '' || kontak_pemilik_edit == '' || alamat_pemilik == ''){
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
        url     = "<?=base_url().'index.php/admin/pemilik/add'?>";
        idForm  = 'formAddPemilikAlat';
        idModal = 'modal-addPemilikAlat';
      }
      if (form == 'edit'){
        url     = "<?=base_url().'index.php/admin/pemilik/update'?>";
        idForm  = 'formEditPemilikAlat';
        idModal = 'modal-editPemilikAlat';
      }
      if (form == 'delete'){
        url     = "<?=base_url().'index.php/admin/pemilik/delete'?>";
        idForm  = 'formDeletePemilikAlat';
        idModal = 'modal-deletePemilikAlat';
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