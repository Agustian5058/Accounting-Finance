<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN LABA RUGI
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Untuk melihat laporan silahkan memilih periode tanggal laporan, tanggal akhir tidak boleh lebih kecil dari tanggal awal. untuk melihat seluruh laporan laba rugi untuk setiap alat dan setiap penanggung jawab, silahakan pilih option semua</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan laba Rugi</b> </h4>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/lap_keuangan/excel'?>" class="btn bg-green btn-md" style="margin-top: 10px;padding-left: 15px;padding-right: 15px;" id="btnExcel"><i class="fa fa-download"></i>&nbsp; Laporan Excel</a>
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
                    Sisa Dana Di AHONG
                  </td>
                  <td>:</td>
                  <td>Rp. <?php echo number_format(($total_penerimaan_ahong-$total_pengeluaran_ahong)); ?></td>
                </tr>
                <tr>
                  <td>
                    Sisa Dana Di MJA
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
      <?php if ($view == 'paper') { ?>
        <!-- ========================== layout data table ============================ -->
        <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Laba Rugi Periode <font style="color: red"><?=$periode?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_labarugi/generate/excel'); ?>">
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
            <table id="tableAlat" class="table table-striped">
            <!-- /.Pemasukan -->
              <tr class="bg-blue">
                <td colspan="7" style="text-align: center;">Pemasukan</td>
              </tr>
              <?php $i=0;
              $total_pendapatan = 0;
              $pemasukan_ahong = 0; 
              $pemasukan_mja = 0; 
              $pengeluaran_ahong = 0; 
              $pengeluaran_mja = 0; 
              foreach ($pendapatan as $list) {  $i++;?>
                <tr>
                  <td colspan="7"><?=$list->nama_client?>  ||  <?=$list->tgl_pemasukan?>  ||  <?=$list->kode_alat?></td>
                </tr>
                <tr>
                  <td rowspan="2" style="vertical-align: middle;text-align: center;"><?=$i?></td>
                  <td colspan="3"><?=$list->lama_pemakaian?> jam x Rp. <?=number_format($list->harga_perjam)?></td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($list->biaya_penyewaan)?>
                    </div>
                  </td>
                  <td rowspan="2" style="vertical-align: middle;text-align: center;"><?=$list->kode_penyedia?></td>
                </tr>
                <tr>
                  <td colspan="3"> PPH 
                    <?php 
                    if($list->pph_penyewaan == 0){
                      $a = 0;
                    } else{
                      $a=$list->pph_penyewaan/$list->biaya_penyewaan*100;
                    } 
                    echo $a;
                    ?> %</td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($list->pph_penyewaan)?></td>
                      <?php 
                        if($list->kode_penyedia == 'MJA') {
                          $pemasukan_mja = $pemasukan_mja+$list->jumlah_pemasukan;
                        }else{
                          $pemasukan_ahong = $pemasukan_ahong+$list->jumlah_pemasukan;
                        }?>
                    </div>
                </tr>
              <?php $total_pendapatan = $total_pendapatan + $list->jumlah_pemasukan; } ?>
              <tr class="bg-blue">
                <td colspan="4">Total Pendapatan Setelah PPH</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($total_pendapatan)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <!-- /.End Pemasukan -->
              <tr>
                <td colspan="7"></td>
              </tr>
              <tr>
                <td colspan="7"></td>
              </tr>

              <!-- /.Pengeluaran -->
              <tr class="bg-red">
                <td colspan="7" style="text-align: center;">Pengeluaran</td>
              </tr>
              <?php $i=0;$total_pengeluaran = 0; foreach ($pengeluaran as $list) {  $i++;?>
                <tr>
                  <td style="vertical-align: middle;text-align: center;"><?=$i?></td>
                  <td><?=$list->keterangan?></td>
                  <td><?=$list->tgl_pengeluaran?></td>
                  <td><?=$list->kode_voucher?></td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($list->jumlah_pengeluaran)?>
                    </div>
                  </td>
                  <td>
                    <?=$list->kode_penyedia?>
                    <?php 
                        if($list->kode_penyedia == 'MJA') {
                          $pengeluaran_mja = $pengeluaran_mja+$list->jumlah_pengeluaran;
                        }else{
                          $pengeluaran_ahong = $pengeluaran_ahong+$list->jumlah_pengeluaran;
                        }?>
                  </td>
                </tr>
              <?php $total_pengeluaran = $total_pengeluaran + $list->jumlah_pengeluaran; } ?>
              <?php $i;$total_pengeluaran_fee = 0; foreach ($pengeluaran_fee as $list) {  $i++;?>
                <tr>
                  <td style="vertical-align: middle;text-align: center;"><?=$i?></td>
                  <td colspan="3">Fee Operasional dari <?=$list->nama_client?> : <?=$list->lama_pemakaian?> jam x Rp. <?=number_format(($list->potongan_fee/$list->lama_pemakaian))?>/jam</td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($list->potongan_fee)?>
                    </div>
                  </td>
                  <td>
                    <?=$list->kode_penyedia?>
                    <?php 
                        if($list->kode_penyedia == 'MJA') {
                          $pengeluaran_mja = $pengeluaran_mja+$list->potongan_fee;
                        }else{
                          $pengeluaran_ahong = $pengeluaran_ahong+$list->potongan_fee;
                        }?>
                  </td>
                </tr>
              <?php $total_pengeluaran_fee = $total_pengeluaran_fee + $list->potongan_fee; } ?>
              <tr class="bg-blue">
                <td colspan="4">Pemasukan via AHONG</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($pemasukan_ahong)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr class="bg-blue">
                <td colspan="4">Pemasukan via MJA</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($pemasukan_mja)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr class="bg-red">
                <td colspan="4">Total Pemasukan</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($total_pendapatan)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr>
              </tr>
              <tr class="bg-blue">
                <td colspan="4">Pengeluaran via AHONG</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($pengeluaran_ahong)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr class="bg-blue">
                <td colspan="4">Pengeluaran via MJA</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($pengeluaran_mja)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr class="bg-red">
                <td colspan="4">Total Pengeluaran</td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($total_pengeluaran + $total_pengeluaran_fee)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr class="bg-green">
                <td colspan="4">Laba Proyek Periode <?=$periode?></td>
                <td>:</td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($total_pendapatan-($total_pengeluaran + $total_pengeluaran_fee))?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <!-- /.End Pengeluaran -->
            </table>
            <div class="clear-fix"></div>
            <hr>
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
            <h3 class="box-title">Lihat laporan Laba Rugi</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_labarugi/generate'); ?>" class="form-horizontal">
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
                  <select name="alat" class="form-control select2" style="width: 100%;" required>
                    <option value="">pilih alat</option>
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
        $('#btnExcel').prop('disabled', true);
    });
  </script>