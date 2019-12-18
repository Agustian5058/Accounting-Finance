<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAPORAN JURNAL HARIAN
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

      <?php if ($view == 'peralat') { ?>
        <!-- ========================== layout data table ============================ -->
        <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan Jurnal Periode <font style="color: red"><?=$periode?></font></b> </h4>
            <div class="box-tools pull-right">
              <form method="POST"  action="<?php echo site_url('index.php/admin/lap_jurnal/generate/excel'); ?>">
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
            .scale{
              -ms-transform: scale(1.5); /* IE 9 */
              -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
              transform: scale(1.5);
            }
          </style>
          <div class="box-body">
            <table id="tableLaporan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No. Voucher</th>
                <th>Tanggal</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Jenis Biaya</th>
                <th>Dana</th>
              </tr>
              </thead>
              <tbody>
              <?php $grand_total=0; foreach ($pengeluaran as $list) { ?>
                <tr>
                  <td style="text-align: center;">
                    <?=$list->kode_voucher?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->tgl_pengeluaran?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->alat?>
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($list->jumlah_pengeluaran)?>
                    </div>
                  </td>
                  <td>
                    <?=$list->keterangan?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->kode_sasaran?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->penanggungjawab?>
                  </td>
                </tr>
              <?php $grand_total = $grand_total + $list->jumlah_pengeluaran; } ?>
              <tr class="bg-red">
                <td colspan="2" style="text-align: center;">
                  Grand Total
                </td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($grand_total)?>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- ============================ end layout data ============================ -->
      <?php } ?>
      <?php if ($view == 'perbiaya') { ?>
        <!-- ========================== layout data table ============================ -->
        <!-- Default box -->
        <div class="box">
          <div class="box-header">
            <h4>&nbsp;<i class="fa fa-book"></i>&nbsp;&nbsp;<b>Laporan jurnal perbiaya <font style="color: red;"><?=' ['.$kode_biaya->kode_sasaran.'] - '.$kode_biaya->sasaran?></font></b> </h4>
            <div class="box-tools pull-right">
              <a href="<?=base_url().'index.php/admin/lap_jurnal/excel'?>" class="btn bg-green btn-md" style="margin-top: 10px;padding-left: 15px;padding-right: 15px;"><i class="fa fa-download"></i>&nbsp; Laporan Excel</a>
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
            .scale{
              -ms-transform: scale(1.5); /* IE 9 */
              -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
              transform: scale(1.5);
            }
          </style>
          <div class="box-body">
            <table id="tableLaporan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tgl Pengeluaran</th>
                <th>No Voucher</th>
                <th>Kode Biaya</th>
                <th>Alat</th>
                <th>Rincian</th>
                <th>Jumlah</th>
                <th>Dana</th>
              </tr>
              </thead>

              <tbody>
              <?php $i = 0; $grand_total=0; foreach ($pengeluaran as $list) { $i++; 

                 $penanggungjawab = "";
                if ($pengeluaran->fee_id) $penanggungjawab = 'Kas Fee';
                else if ($pengeluaran->kode_pemilik) $penanggungjawab = $pengeluaran->kode_pemilik;
                else if ($pengeluaran->kode_penyedia) $penanggungjawab = $pengeluaran->kode_penyedia;

                if (strlen($pengeluaran->keterangan) > 20 ) $ket = substr($pengeluaran->keterangan,0,20).'...';
                else $ket = $pengeluaran->keterangan;
                ?>
                <tr>
                  <td style="text-align: center;">
                    <?=$i?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->tgl_pengeluaran?>
                  </td>
                  <td>
                      <?=$list->kode_voucher?>
                  </td>
                  <td>
                    <?=$list->kode_sasaran?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->alat?>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->ket?>
                  </td>
                  <td>
                    <div class="left">Rp. </div><div class="right">
                      <?=number_format($jumlah_pengeluaran)?>
                    </div>
                  </td>
                  <td style="text-align: center;">
                    <?=$list->penanggungjawab?>
                  </td>
                </tr>
              <?php $grand_total = $grand_total + $list->jumlah_pengeluaran; } ?>
              <tr class="bg-red">
                <td colspan="2" style="text-align: center;">
                  Grand Total
                </td>
                <td>
                  <div class="left">Rp. </div><div class="right">
                    <?=number_format($grand_total)?>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
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
          <form role="form" method="POST" action="<?php echo site_url('index.php/admin/lap_jurnal/generate'); ?>" class="form-horizontal">
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