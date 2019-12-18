<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN KEUANGAN
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Untuk melihat laporan silahkan memilih periode tanggal laporan, tanggal akhir tidak boleh lebih kecil dari tanggal awal. untuk melihat seluruh laporan keuangan untuk setiap alat dan setiap penanggung jawab, silahakan pilih option semua</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Keuangan Periode <font style="color: red"><?=$periode?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_keuangan/generate/excel'); ?>">
              <input type="hidden" name="tgl_awal" value="<?=$excel['tgl_awal']?>">
              <input type="hidden" name="tgl_akhir" value="<?=$excel['tgl_akhir']?>">
              <input type="hidden" name="alat" value="<?=$excel['alat_id']?>">
              <button type="submit" class="btn bg-green btn-md" style="margin-top: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-download"></i>&nbsp; Laporan Excel</button>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <style type="text/css">
            table tr th {
              text-align: center;
              vertical-align: middle;
            }
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
            <table id="tableAlat" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle">Kode Alat</th>
                <th rowspan="2" style="vertical-align: middle">Hasil</th>
                <th colspan="2">Pemasukan</th>
                <th colspan="2">Pengeluaran</th>
                <th colspan="2">Sisa</th>
              </tr>
              <tr>
                <th>AHONG</th>
                <th>MJA</th>
                <th>AHONG</th>
                <th>MJA</th>
                <th>AHONG</th>
                <th>MJA</th>
              </tr>
              </thead>
              <tbody>
              <?php 
              $total_penerimaan_ahong  = 0;
              $total_penerimaan_mja    = 0;
              $total_pengeluaran_ahong = 0;
              $total_pengeluaran_mja   = 0;
              foreach ($laporan as $list) { ?>
              <tr>
                <td><?=$list[0]?></td> <!--No-->
                <td><?=$list[1]?></td> <!--Kode Alat-->
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[2])?>
                  </div>
                </td> <!--Hasil Alat--> 
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[3])?>
                  </div>
                </td> <!--Pem. AHONG--> <?php $total_penerimaan_ahong = $total_penerimaan_ahong+$list[3];?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[4])?>
                  </div>
                </td> <!--Pe. MJA--> <?php $total_penerimaan_mja = $total_penerimaan_mja+$list[4];?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[5])?>
                  </div>
                </td> <!--Peng.AHONG--><?php $total_pengeluaran_ahong=$total_pengeluaran_ahong+$list[5];?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[6])?>
                  </div>
                </td> <!--Peng. MJA--><?php $total_pengeluaran_mja=$total_pengeluaran_mja+$list[6];?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[7])?>
                  </div>
                </td> <!--Sisa Dana AHONG-->
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list[8])?>
                  </div>
                </td> <!--Sisa Dana MJA-->
              </tr>
              <?php } ?>
              </tfoot>
            </table>
            <div class="clear-fix"></div>
            <hr>
            <div class="col-md-4">
              <table class="table table-striped">
                <tr>
                  <td>
                    DANA ALAT DI AHONG
                  </td>
                  <td>:</td>
                  <td>Rp. <?php echo number_format(($total_penerimaan_ahong-$total_pengeluaran_ahong)); ?></td>
                </tr>
                <tr>
                  <td>
                    DANA ALAT DI MJA
                  </td>
                  <td>:</td>
                  <td>Rp. <?php echo number_format(($total_penerimaan_mja-$total_pengeluaran_mja)); ?></td>
                </tr>
              </table>
            </div>
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
            <h3 class="box-title">Lihat laporan</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_keuangan/generate'); ?>" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-md-2 control-label">Periode</label>
                <div class="col-md-3">
                  <input name="tgl_awal" type="text" class="form-control datepicker" placeholder="Tgl Awal" required>
                </div>
                <div class="col-md-1">
                  Sampai
                </div>
                <div class="col-md-3">
                  <input name="tgl_akhir" type="text" class="form-control datepicker"  placeholder="Tgl Akhir" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Alat</label>
                <div class="col-md-7">
                  <select name="alat" class="form-control select2" style="width: 100%;"  >
                    <option value="">semua</option>
                    <?php
                      foreach ($alat as $list) {
                    ?>
                      <option value="<?=$list->alat_id?>" <?php if (isset($data_edit)) { if ($data_edit['alat_id'] == $list->alat_id) {echo 'selected';} }?>><?=$list->kode_alat.' - '.$list->nama_alat?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="reset" class="btn btn-default pull-left">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Lihat Laporan</button>
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
    $(document).ready(function() {
        $('.datepicker').datepicker({format: 'yyyy/mm/dd' });
        $('.select2').select2();
    });
  </script>