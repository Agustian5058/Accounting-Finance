<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_labarugi_".$periode.".xls");
?>
<table border="1">
  <tr>
    <td colspan="7" style="text-align: center;">
      LAPORAN LABA RUGI
    </td>
  </tr>
  <tr>
    <td colspan="7" style="text-align: center;">
      PERIODE <?=$periode?>
    </td>
  </tr>
  <tr><td colspan="7"></td></tr>
  <tr><td colspan="7"></td></tr>
  <tr><td colspan="7"></td></tr>
  <tr>
  <td colspan="7">Pemasukan</td>
  </tr>
  <?php $i=0;
    $total_pendapatan = 0;
    $pemasukan_ahong = 0; 
    $pemasukan_mja = 0; 
    $pengeluaran_ahong = 0; 
    $pengeluaran_mja = 0; 
    foreach ($pendapatan as $list) {  $i++;?>
    <tr>
      <td colspan="7"><?=$list->nama_client?></td>
    </tr>
    <tr>
      <td rowspan="2"><?=$i?></td>
      <td colspan="3"><?=$list->lama_pemakaian?> jam x Rp. <?=$list->harga_perjam?></td>
      <td>:</td>
      <td>
        <?=($list->biaya_penyewaan)?>
      </td>
      <td rowspan="2" style="vertical-align: middle;text-align: center;"><?=$list->kode_penyedia?>
  <?php 
  if($list->kode_penyedia == 'MJA') {
    $pemasukan_mja = $pemasukan_mja+$list->jumlah_pemasukan;
  }else{
    $pemasukan_ahong = $pemasukan_ahong+$list->jumlah_pemasukan;
  }?>
      </td>
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
        <?=($list->pph_penyewaan)?>
      </td>
    </tr>
    <?php $total_pendapatan = $total_pendapatan + $list->jumlah_pemasukan; } ?>
    <tr>
      <td colspan="4">Total Pendapatan Setelah PPH</td>
      <td>:</td>
      <td>
        <?=($total_pendapatan)?>
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
    <tr>
      <td colspan="7">Pengeluaran</td>
      </tr>
        <?php $i=0;$total_pengeluaran = 0; foreach ($pengeluaran as $list) {  $i++;?>
      <tr>
        <td style="vertical-align: middle;text-align: center;"><?=$i?></td>
        <td><?=$list->keterangan?></td>
        <td><?=$list->tgl_pengeluaran?></td>
        <td><?=$list->kode_voucher?></td>
        <td>:</td>
        <td>
          <?=($list->jumlah_pengeluaran)?>
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
                  <td><?=$i?></td>
                  <td colspan="3">Fee Operasional dari <?=$list->nama_client?> : <?=$list->lama_pemakaian?> jam x Rp. <?=number_format(($list->potongan_fee/$list->lama_pemakaian))?>/jam</td>
                  <td>:</td>
                  <td>
                      <?=($list->potongan_fee)?>
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
              <tr>
                <td colspan="4">Pemasukan via Ahong</td>
                <td>:</td>
                <td>
                    <?=($pemasukan_ahong)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Pemasukan via MJA</td>
                <td>:</td>
                <td>
                    <?=($pemasukan_mja)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Total Pemasukan</td>
                <td>:</td>
                <td>
                    <?=($total_pendapatan)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Pengeluaran via Ahong</td>
                <td>:</td>
                <td>
                    <?=($pengeluaran_ahong)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Pengeluaran via MJA</td>
                <td>:</td>
                <td>
                    <?=($pengeluaran_mja)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Total Pengeluaran</td>
                <td>:</td>
                <td>
                    <?=($total_pengeluaran + $total_pengeluaran_fee)?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4">Laba Proyek Periode <?=$periode?></td>
                <td>:</td>
                <td>
                  <?=($total_pendapatan-($total_pengeluaran + $total_pengeluaran_fee))?>
                </td>
                <td></td>
              </tr>
              <!-- /.End Pengeluaran -->
            </table>
  <tbody>
</table>