<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PENYEWA ALAT
        <small>Data seluruh penyewa alat yang ada pada PT</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Penyewa ALat ini berguna untuk merecord seluruh perusahaan/badan/instansi yang melakukan penyewaan alat</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <a class="btn btn-primary btn-md" onclick="add_pemakaialat()"><i class="fa fa-plus"></i>&nbsp;Tambah Penyewa</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tablePemakaiAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Penyewa</th>
                <th>Nama Penyewa</th>
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
  <div class="modal fade" id="modal-addPemakaiAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Pemakai Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formaddPemakaiAlat">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Penyewa</label>
                <input name="nama_penyewa" type="text" class="form-control" placeholder="Nama Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Penyewa</label>
                <input name="kode_penyewa" type="text" class="form-control" placeholder="Kode Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Alamat Penyewa</label>
                <input name="alamat_penyewa" type="text" class="form-control" placeholder="Alamat Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Kontak Penyewa</label>
                <input name="kontak_penyewa" type="text" class="form-control" placeholder="Kontak Pemakai Alat" required>
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

  <div class="modal fade" id="modal-editPemakaiAlat">
    <div class="modal-dialog modal-md" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Alat</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="formeditPemakaiAlat">
            <div class="box-body">
            <div class="form-group">
                <input name="penyewa_id_edit" type="hidden">
              </div>
              <div class="form-group">
                <label>Nama Pemakai</label>
                <input name="nama_penyewa_edit" type="text" class="form-control" placeholder="Nama Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Kode Pemakai</label>
                <input name="kode_penyewa_edit" type="text" class="form-control" placeholder="Kode Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input name="alamat_penyewa_edit" type="text" class="form-control" placeholder="Alamat Pemakai Alat" required>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input name="kontak_penyewa_edit" type="text" class="form-control" placeholder="Kontak Pemakai Alat" required>
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

  <div class="modal modal-danger fade" id="modal-deletePemakaiAlat">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Penyewa</h4>
        </div>
        <div class="modal-body">
          <p><i class="fa fa-warning"></i> &nbsp;&nbsp;Anda Yakin Ingin Menghapus Data Penyewa Ini ? </p>
          <form role="form" id="formDeletePemakaiAlat">
            <div class="box-body">
              <div class="form-group">
                <input name="penyewa_id_delete" type="hidden" value="">
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
        table = $('#tablePemakaiAlat').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('index.php/admin/client/list')?>",
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

    function add_pemakaialat(){
        $('#formaddPemakaiAlat')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-addPemakaiAlat').modal('show'); // show bootstrap modal
    }

    function edit_pemakaialat(id){
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/admin/client/edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="penyewa_id_edit"]').val(data.client_id);
              $('[name="nama_penyewa_edit"]').val(data.nama_client);
              $('[name="kode_penyewa_edit"]').val(data.kode_client);
              $('[name="alamat_penyewa_edit"]').val(data.alamat_client);
              $('[name="kontak_penyewa_edit"]').val(data.kontak_client);

              $('#modal-editPemakaiAlat').modal('show'); // show bootstrap modal when complete loaded
              $('.select2').select2();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

    function delete_pemakaialat(step, id){
      if (step == 'ask'){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="penyewa_id_delete"]').val(id);
        $('#modal-deletePemakaiAlat').modal('show'); // show bootstrap modal
      }
    }

    function validation(form){
      if (form == 'add'){
        var nama_penyewa   = $('[name="nama_penyewa"]').val();
        var kode_penyewa   = $('[name="kode_penyewa"]').val();
        var alamat_penyewa  = $('[name="alamat_penyewa"]').val();
        var kontak_penyewa = $('[name="kontak_penyewa"]').val();

        if (nama_penyewa == '' || kode_penyewa == '' || alamat_penyewa == '' || kontak_penyewa == ''){
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
        url     = "<?=base_url().'index.php/admin/client/add'?>";
        idForm  = 'formaddPemakaiAlat';
        idModal = 'modal-addPemakaiAlat';
      }
      if (form == 'edit'){
        url     = "<?=base_url().'index.php/admin/client/update'?>";
        idForm  = 'formeditPemakaiAlat';
        idModal = 'modal-editPemakaiAlat';
      }
      if (form == 'delete'){
        url     = "<?=base_url().'index.php/admin/client/delete'?>";
        idForm  = 'formDeletePemakaiAlat';
        idModal = 'modal-deletePemakaiAlat';
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