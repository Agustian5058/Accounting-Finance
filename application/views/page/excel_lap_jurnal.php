<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_jurnalharian_".$periode.".xls");
?>
<table border="1">

  <tr>
    <td colspan="6" style="text-align: center;">
      LAPORAN JURNAL HARIAN
    </td>
  </tr>
  <tr>
    <td colspan="6" style="text-align: center;">
      PERIODE <?=$periode?>
    </td>
  </tr>
  <tr><td colspan="6"></td></tr>
  <tr><td colspan="6"></td></tr>
  <tr><td colspan="6"></td></tr>

<tr>
                <th>No. Voucher</th>
                <th>Tanggal</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Jenis Biaya</th>
                <th>Dana</th>
              </tr>

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
                      <?=($list->jumlah_pengeluaran)?>
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
              <tr>
                <td colspan="2" style="text-align: center;">
                  Grand Total
                </td>
                <td>
                    <?=($grand_total)?>
                </td>
              </tr>

  </table>