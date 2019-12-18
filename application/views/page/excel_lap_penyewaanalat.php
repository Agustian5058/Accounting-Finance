<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_sewaalat_".$periode.".xls");
?>
<table border="1">
<thead>
<tr>
    <td colspan="11" style="text-align: center;">
      LAPORAN PENYEWAAN ALAT
    </td>
  </tr>
  <tr>
    <td colspan="11" style="text-align: center;">
      PERIODE <?=$periode?>
    </td>
  </tr>
  <tr><td colspan="11"></td></tr>
  <tr><td colspan="11"></td></tr>
  <tr><td colspan="11"></td></tr>
              <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Tanggal Sewa</th>
                <th>Lama Penyewaan (Jam)</th>
                <th>Penyewa</th>
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
                    <?=($list->harga_perjam)?>
                </td>
                <td>
                    <?=($list->biaya_penyewaan)?>
                </td>
                <td>
                    <?=($list->pph_penyewaan)?>
                </td>
                <td>
                    <?=($list->potongan_fee)?>
                </td>
                <td>
                    <?=(($list->jumlah_pemasukan - $list->potongan_fee))?>
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
              <table>
                <tr>
                  <td>
                    Pemasukan Melalui AHONG
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_via_ahong)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Pemasukan Melalui MJA
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_via_mja)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Fee Operasional di AHONG
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_fee_ahong)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Fee Operasional di MJA
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_fee_mja)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Total PPH
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_pph)); ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Total Dana
                  </td>
                  <td>:</td>
                  <td>
                      <?php echo (($total_pemasukan)); ?>
                  </td>
                </tr>
              </table>