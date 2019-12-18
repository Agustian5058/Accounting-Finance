<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN BELANJA TOKO
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Untuk melihat laporan silahkan memilih periode tanggal laporan, tanggal akhir tidak boleh lebih kecil dari tanggal awal. untuk melihat seluruh laporan fee operasional untuk setiap alat dan setiap penanggung jawab, silahakan pilih option semua</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Belanja Toko Periode <font style="color: red"><?=$periode?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_belanjatoko/generate/excel'); ?>">
              <input type="hidden" name="tgl_awal" value="<?=$excel['tgl_awal']?>">
              <input type="hidden" name="tgl_akhir" value="<?=$excel['tgl_akhir']?>">
              <input type="hidden" name="toko" value="<?=$excel['toko']?>">
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
                <th>Tgl Pengeluaran</th>
                <th>No. Voucher</th>
                <th>Alat</th>
                <th>Biaya</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Toko</th>
                <th>Dana</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                $total_via_ahong = 0;
                $total_via_mja   = 0;
                $total_fee = 0;
                $grand_total=0; 
                foreach ($belanja as $list) { ?>
                  <tr>
                    <td style="text-align: center;">
                      <?=$list->tgl_pengeluaran?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->kode_voucher?>
                    </td>
                     <td style="text-align: center;">
                      <?=$list->alat?>
                    </td>
                     <td style="text-align: center;">
                      <?=$list->kode_sasaran?>
                    </td>
                    <td>
                      <?=$list->keterangan?>
                    </td>
                    <td>
                      <div class="left">Rp. </div><div class="right">
                        <?=number_format($list->jumlah_pengeluaran)?>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->toko?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->penanggungjawab?>
                    </td>
                  </tr>
                <?php 
                  if($list->penanggungjawab == 'MJA') {
                      $total_via_mja = $total_via_mja+($list->jumlah_pengeluaran);
                    }else if ($list->penanggungjawab == 'AHONG') {
                      $total_via_ahong = $total_via_ahong+($list->jumlah_pengeluaran);
                    }else{
                      $total_fee = $total_fee+($list->jumlah_pengeluaran);
                    }
                    $grand_total = $grand_total + $list->jumlah_pengeluaran; 
                  } ?>
                <tr class="bg-green">
                  <td colspan="5" style="text-align: center;">
                    Total Belanja Via Ahong
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($total_via_ahong)?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td colspan="5" style="text-align: center;">
                    Total Belanja Via MJA
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($total_via_mja)?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td colspan="5" style="text-align: center;">
                    Total Belanja Via Kas Fee
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($total_fee)?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td colspan="5" style="text-align: center;">
                    Grand Total Belanja <?=$toko->nama_toko?>
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($grand_total)?>
                    </div>
                  </td>
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
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_belanjatoko/generate'); ?>" class="form-horizontal">
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
                <label class="col-md-2 control-label">Toko</label>
                <div class="col-md-7">
                  <select name="toko" class="form-control select2" style="width: 100%;" required>
                    <option value="">pilih toko</option>
                    <?php
                      foreach ($toko as $list) {
                    ?>
                      <option value="<?=$list->toko_id?>"><?=$list->kode_toko.' - '.$list->nama_toko?></option>
                    <?php } ?>
                  </select>
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