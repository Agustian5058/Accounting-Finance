<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_keuangan_".$periode.".xls");
?>
<table border="1">
  <thead>

  <tr>
    <td colspan="9" style="text-align: center;">
      LAPORAN KEUANGAN PENYEWAAN ALAT
    </td>
  </tr>
  <tr>
    <td colspan="9" style="text-align: center;">
      PERIODE <?=$periode?>
    </td>
  </tr>
  <tr><td colspan="9"></td></tr>
  <tr><td colspan="9"></td></tr>
  <tr><td colspan="9"></td></tr>
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
    <td style="text-align: center;"><?=$list[0]?></td> <!--No-->
    <td><?=$list[1]?></td> <!--Kode Alat-->
    <td><?=$list[2]?></td> <!--Hasil Alat--> 
    <td><?=$list[3]?></td> <!--Pem. AHONG--> <?php $total_penerimaan_ahong = $total_penerimaan_ahong+$list[3];?>
    <td><?=$list[4]?></td> <!--Pe. MJA--> <?php $total_penerimaan_mja = $total_penerimaan_mja+$list[4];?>
    <td><?=$list[5]?></td> <!--Peng.AHONG--><?php $total_pengeluaran_ahong=$total_pengeluaran_ahong+$list[5];?>
    <td><?=$list[6]?></td> <!--Peng. MJA--><?php $total_pengeluaran_mja=$total_pengeluaran_mja+$list[6];?>
    <td><?=$list[7]?></td> <!--Sisa Dana AHONG-->
    <td><?=$list[8]?></td> <!--Sisa Dana MJA-->
  </tr>
  <?php } ?>
  <tr><td colspan="9"></td></tr>
  <tr><td colspan="9"></td></tr>
  <tr><td colspan="9"></td></tr>
  <tr>
    <td colspan="2">
      DANA ALAT DI AHONG
    </td>
    <td>:</td>
    <td><?php echo ($total_penerimaan_ahong-$total_pengeluaran_ahong); ?></td>
  </tr>
  <tr>
    <td colspan="2">
      DANA ALAT DI MJA
    </td>
    <td>:</td>
    <td><?php echo ($total_penerimaan_mja-$total_pengeluaran_mja); ?></td>
  </tr>
</table>