<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA PENYEDIA JASA
        <small>data perusahaan pyang menjalankan operasional</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Data Penyedia Jasa Merupakan data orang/instansi/perusahaan yang menjalankan operasional usaha</p>
      </div>
      <!-- Default box -->
        <div class="box">
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tablePemakaiAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Penyedia</th>
                <th>Nama Penyedia</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 0; foreach ($penyedia as $list) { $no++;?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$list->kode_penyedia?></td>
                  <td><?=$list->nama_penyedia?></td>
                </tr>
              <?php } ?>
               </tbody>
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
<script type="text/javascript">
  $(function () {
    $('#tablePemakaiAlat').DataTable()
  })
</script>
