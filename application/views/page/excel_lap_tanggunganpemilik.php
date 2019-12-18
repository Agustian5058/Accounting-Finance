<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_tanggunganpemilik_".$periode.".xls");
?>
<table border="1">

  <tr>
    <td colspan="8" style="text-align: center;">
      LAPORAN KEUANGAN PEMILIK ALAT
    </td>
  </tr>
  <tr>
    <td colspan="8" style="text-align: center;">
      PERIODE <?=$periode?>
    </td>
  </tr>
  <tr><td colspan="8"></td></tr>
  <tr><td colspan="8"></td></tr>
  <tr><td colspan="8"></td></tr>

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
                <?php $grand_total=0; foreach ($belanja as $list) { ?>
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
                        <?=($list->jumlah_pengeluaran)?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->toko?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->penanggungjawab?>
                    </td>
                  </tr>
                <?php $grand_total = $grand_total + $list->jumlah_pengeluaran; } ?>
                <tr>
                  <td colspan="5" style="text-align: center;">
                    Grand Total Tanggungan <?=$pemilik->nama_pemilik?>
                  </td>
                  <td>
                      <?=($grand_total)?>
                  </td>
                </tr>

  </table>