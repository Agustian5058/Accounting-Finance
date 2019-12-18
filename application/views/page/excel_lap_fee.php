<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_fee_".$periode.".xls");
?>
<table border="1">
<thead>
<tr>
    <td colspan="6" style="text-align: center;">
      LAPORAN FEE OPERASIONAL
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
                <th>No</th>
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
                <th></th>
                <td>
                    <?=(0)?>
                </td> <!--Hasil Alat--> 
                <td>
                    <?=(0)?>
                </td><?php $saldo = $saldo+$saldosebelum;?>
                <td>
                    <?=($saldo)?>
                </td>
                <td>
                </td>
              </tr>
              <tr>
                <td>2</td> <!--No-->
                <td>Saldo Fee Per <?=$tgl_akhir?></td> <!--Kode Alat-->
                <th></th>
                <td>
                    <?=($pemasukan_fee[0]->jumlah_pemasukan_fee)?>
                </td> <!--Hasil Alat--> 
                <td>
                    <?=(0)?>
                </td><?php $saldo = $saldo+$pemasukan_fee[0]->jumlah_pemasukan_fee;?>
                <td>
                    <?=($saldo)?>
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
                    <?=(0)?>
                </td> <!--Hasil Alat--> 
                <td>
                    <?=($list->jumlah_pengeluaran)?>
                </td><?php $saldo = $saldo-$list->jumlah_pengeluaran;?>
                <td>
                    <?=($saldo)?>
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
              <tr><td colspan="6"></td></tr>
              <tr><td colspan="6"></td></tr>
                <?php foreach ($keterangan_fee as $list) { ?>
                  <tr>
                    <td>
                      Sisa Kas Fee di <?=$list->kode_penyedia?>
                    </td>
                    <td>:</td>
                    <td>
                        <?php echo (($list->fee_debit)  - ($list->fee_kredit)); ?>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <td>
                    Pengeluaran Melalui AHONG
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_via_ahong)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Pengeluaran Melalui MJA
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_via_mja)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Sisa Dana
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($saldo)); ?> 
                  </td>
                </tr>
</table>