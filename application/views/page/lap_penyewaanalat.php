<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN Penyewaan Alat
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- ============================ alert and note =============================== -->
      <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Untuk melihat laporan silahkan memilih periode tanggal laporan, tanggal akhir tidak boleh lebih kecil dari tanggal awal. untuk melihat seluruh laporan penyewaan alat untuk setiap alat dan setiap penanggung jawab, silahakan pilih option semua</p>
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
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Penyewaan Alat Periode <font style="color: red"><?=$periode?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_penyewaanalat/generate/excel'); ?>">
              <input type="hidden" name="tgl_awal" value="<?=$excel['tgl_awal']?>">
              <input type="hidden" name="tgl_akhir" value="<?=$excel['tgl_akhir']?>">
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
                <th>Nama Alat</th>
                <th>Penyewa</th>
                <th>Tanggal Sewa</th>
                <th>Lama Penyewaan (Jam)</th>
                <th>Harga</th>
                <th>Biaya Sewa</th>
                <th>PPH</th>
                <th>Fee Ops</th>
                <th>Total</th>
                <th>Penerima</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $total_via_ahong = 0;
                $total_via_mja   = 0;
                $total_pemasukan = 0;
                $total_pph = 0;
                $total_fee_mja = 0;
                $total_fee_ahong = 0;
                $saldo = 0;
              ?>
              <?php $i=0; foreach ($pemasukan as $list) { $i++;?>
              <tr>
                <td><?=$i?></td> <!--No-->
                <td><?=$list->kode_alat?></td> <!--Kode Alat--> 
                <td><?=$list->nama_client?></td>
                <td><?=$list->tgl_pemasukan?></td>
                <td><?=$list->lama_pemakaian?></td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list->harga_perjam)?>
                  </div>
                </td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list->biaya_penyewaan)?>
                  </div>
                </td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list->pph_penyewaan)?>
                  </div>
                </td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format($list->potongan_fee)?>
                  </div>
                </td>
                <td>
                  <div class="left">Rp. </div>
                  <div class="right">
                    <?=number_format(($list->jumlah_pemasukan - $list->potongan_fee))?>
                  </div>
                </td>
                <td>
                  <?=$list->kode_penyedia?>
                  <?php 
                    if($list->kode_penyedia == 'MJA') {
                      $total_via_mja = $total_via_mja+($list->jumlah_pemasukan - $list->potongan_fee);
                      $total_fee_mja = $total_fee_mja+$list->potongan_fee;
                      $total_pph = $total_pph+$list->pph_penyewaan;
                      $total_pemasukan = $total_pemasukan+($list->jumlah_pemasukan - $list->potongan_fee);
                    }else{
                      $total_via_ahong = $total_via_ahong+($list->jumlah_pemasukan - $list->potongan_fee);
                      $total_fee_ahong = $total_fee_ahong+$list->potongan_fee;
                      $total_pph = $total_pph+$list->pph_penyewaan;
                      $total_pemasukan = $total_pemasukan+($list->jumlah_pemasukan - $list->potongan_fee);
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
                <tr class="bg-red">
                  <td>
                    Pemasukan Melalui AHONG
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
                    Pemasukan Melalui MJA
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_via_mja)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td>
                    Fee Operasional di AHONG
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_fee_ahong)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td>
                    Fee Operasional di MJA
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_fee_mja)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td>
                    Total PPH
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_pph)); ?>
                    </div>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td>
                    Total Dana
                  </td>
                  <td>:</td>
                  <td>
                    <div class="left">Rp. </div>
                    <div class="right">
                      <?php echo number_format(($total_pemasukan)); ?>
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
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_penyewaanalat/generate'); ?>" class="form-horizontal">
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