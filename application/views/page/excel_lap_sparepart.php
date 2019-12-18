<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_sparepart_".$periode.".xls");
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
                <th style="vertical-align: middle">No</th>
                <th>Toko</th>
                <th>Tgl Pengeluaran</th>
                <th>No. Voucher</th>
                <th>Alat</th>
                <th>Biaya</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Dana</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $total_via_ahong = 0;
                $total_via_mja   = 0;
                $total_fee = 0;
                $grand_total = 0;
                $i=0;
                foreach ($sparepart as $list) { ?>
                  <tr>
                    <td><?=$i?></td>
                    <td style="text-align: center;">
                      <?=$list->nama_toko?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->tgl_pengeluaran?>
                    </td>
                    <td style="text-align: center;">
                      <?=$list->kode_voucher?>
                    </td>
                     <td style="text-align: center;">
                      <?=$list->kode_alat?>
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
                      <?php
                      if($list->kode_penyedia == 'MJA') {
                        echo 'MJA';
                      }else if ($list->kode_penyedia == 'AHONG') {
                        echo 'AHONG';
                      }else{
                        echo 'Kas Fee';
                      }?>
                    </td>
                  </tr>
                  <?php 
                    if($list->kode_penyedia == 'MJA') {
                      $total_via_mja = $total_via_mja+($list->jumlah_pengeluaran);
                    }else if ($list->kode_penyedia == 'AHONG') {
                      $total_via_ahong = $total_via_ahong+($list->jumlah_pengeluaran);
                    }else{
                      $total_fee = $total_fee+($list->jumlah_pengeluaran);
                    }
                    $i++;
                    $grand_total = $grand_total + $list->jumlah_pengeluaran; } ?>
                <tr class="bg-green">
                  <td colspan="7" style="text-align: center;">
                    Total Belanja Via Ahong
                  </td>
                  <td>
                      <?=($total_via_ahong)?>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td colspan="7" style="text-align: center;">
                    Total Belanja Via MJA
                  </td>
                  <td>
                      <?=($total_via_mja)?>
                  </td>
                </tr>
                <tr class="bg-green">
                  <td colspan="7" style="text-align: center;">
                    Total Belanja Via Kas Fee
                  </td>
                  <td>
                      <?=($total_fee)?>
                  </td>
                </tr>
                <tr class="bg-red">
                  <td colspan="7" style="text-align: center;">
                    Total Belanja Keseluruhan
                  </td>
                  <td>
                      <?=($grand_total)?>
                  </td>
                </tr>
                </tbody>
  </table>