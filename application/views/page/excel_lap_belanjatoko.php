<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_belanjatoko_".$periode.".xls");
?>
<table border="1">

  <tr>
    <td colspan="8" style="text-align: center;">
      LAPORAN BELANJA TOKO
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
  <?=($list->jumlah_pengeluaran)?>
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
  $grand_total = $grand_total + $list->jumlah_pengeluaran; } ?>
  <tr class="bg-green">
  <td colspan="5" style="text-align: center;">
  Total Belanja Via Ahong
  </td>
  <td>
  <?=($total_via_ahong)?>
  </td>
  </tr>
  <tr class="bg-green">
  <td colspan="5" style="text-align: center;">
  Total Belanja Via MJA
  </td>
  <td>
  <?=($total_via_mja)?>
  </td>
  </tr>
  <tr class="bg-green">
  <td colspan="5" style="text-align: center;">
  Total Belanja Via Kas Fee
  </td>
  <td>
  <?=($total_fee)?>
  </td>
  </tr>
  <tr class="bg-red">
  <td colspan="5" style="text-align: center;">
  Grand Total Belanja <?=$toko->nama_toko?>
  </td>
  <td>
  <?=($grand_total)?>
  </td>
  </tr>
  </table>