<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN FEE OPERASIONAL
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Fee Operasional Periode <font style="color: red"><?=$periode?><?=$jenis_biaya ? ' di '.$jenis_biaya->sasaran : ''?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_fee/generate/excel'); ?>">
              <input type="hidden" name="tgl_awal" value="<?=$excel['tgl_awal']?>">
              <input type="hidden" name="tgl_akhir" value="<?=$excel['tgl_akhir']?>">
              <input type="hidden" name="jenis_biaya" value="<?=$excel['jenis_biaya']?>">
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
                <th style="vertical-align: middle">No</th>
                <th>Rincian</th>
                <th>Jenis Biaya</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
                <th>Keterangan</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $saldosebelum = $pendapatan_fee_sebelum[0]->jumlah_pemasukan_fee - $pengeluaran_fee_sebelum[0]->jumlah_pengeluaran_fee;
                $total_via_ahong = 0;
                $total_via_mja   = 0;
                $total_pemasukan = 0;
                $saldo = 0;
              ?>
              <tr>
                <td>1</td> <!--No-->
                <td>Saldo Fee Sebelum <?=$tgl_awal?></td> <!--Kode Alat-->
                <td></td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format(0)?>
                  </div>
                </td> <!--Hasil Alat-->
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format(0)?>
                  </div>
                </td><?php $saldo = $saldo+$saldosebelum;?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($saldo)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <tr>
                <td>2</td> <!--No-->
                <td>Saldo Fee Per <?=$tgl_akhir?></td> <!--Kode Alat--> 
                <td></td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($pemasukan_fee[0]->jumlah_pemasukan_fee)?>
                  </div>
                </td> <!--Hasil Alat--> 
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format(0)?>
                  </div>
                </td><?php $saldo = $saldo+$pemasukan_fee[0]->jumlah_pemasukan_fee;?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($saldo)?>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <?php $i=2; foreach ($pengeluaran_fee as $list) { $i++;?>
              <tr>
                <td><?=$i?></td> <!--No-->
                <td><?=$list->keterangan?></td> <!--Kode Alat-->
                <td>
                  <?=$list->sasaran?>
                </td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format(0)?>
                  </div>
                </td> <!--Hasil Alat--> 
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list->jumlah_pengeluaran)?>
                  </div>
                </td><?php $saldo = $saldo-$list->jumlah_pengeluaran;?>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($saldo)?>
                  </div>
                </td>
                <td>
                  <?=$list->kode_penyedia?>
                  <?php 
                    if($list->kode_penyedia == 'MJA') {
                      $total_via_mja = $total_via_mja+$list->jumlah_pengeluaran;
                    }else{
                      $total_via_ahong = $total_via_ahong+$list->jumlah_pengeluaran;
                    }?>
                </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>
            <div class="clear-fix"></div>
            <hr>
            <div class="col-md-6">
              <table class="table table-striped">
                <?php foreach ($keterangan_fee as $list) { ?>
                  <tr class="bg-gray">
                    <td>
                      Sisa Kas Fee di <?=$list->kode_penyedia?>
                    </td>
                    <td>:</td>
                    <td>
                      <div class="left">Rp. </div>
                      <div class="right">
                        <?php echo number_format(($list->fee_debit) - ($list->fee_kredit)); ?>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
                <tr class="bg-red">
                  <td>
                    Pengeluaran Melalui AHONG
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_via_ahong)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td>
                    Pengeluaran Melalui MJA
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_via_mja)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td>
                    Sisa Dana
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($saldo)); ?>
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
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_fee/generate'); ?>" class="form-horizontal">
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
                <label class="col-md-2 control-label">Jenis Biaya</label>
                <div class="col-md-7">
                  <select name="jenis_biaya" class="form-control select2" style="width: 100%;" >
                    <option value="">-- Semua jenis biaya --</option>
                    <?php
                      foreach ($jenis_biaya as $list) {
                    ?>
                      <option value="<?=$list->sasarandana_id?>" <?php if (isset($data_edit)) { if ($data_edit['jenis_biaya'] == $list->sasarandana_id) {echo 'selected';} }?>><?='['.$list->kode_sasaran.'] - '.$list->sasaran?></option>
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