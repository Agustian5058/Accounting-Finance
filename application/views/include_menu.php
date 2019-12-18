<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
          <a href="<?=base_url().'index.php/admin/'?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php if ($page_name == 'alat' || $page_name == 'pemilik' || $page_name == 'client' || $page_name == 'penyedia' || $page_name == 'toko' || $page_name == 'sasaran_dana') echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Data Penting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page_name == 'alat') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/alat'?>"><i class="fa fa-circle-o"></i> Alat</a></li>
            <li class="<?php if ($page_name == 'pemilik') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/pemilik'?>"><i class="fa fa-circle-o"></i> Pemilik Alat</a></li>
            <li class="<?php if ($page_name == 'client') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/client'?>"><i class="fa fa-circle-o"></i> Penyewa Alat</a></li>
            <li class="<?php if ($page_name == 'penyedia') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/penyedia'?>"><i class="fa fa-circle-o"></i> Penyedia Jasa</a></li>
            <li class="<?php if ($page_name == 'toko') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/toko'?>"><i class="fa fa-circle-o"></i> Toko / Supplier</a></li>
            <li class="<?php if ($page_name == 'sasaran_dana') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/sasaran_dana'?>"><i class="fa fa-circle-o"></i> Jenis Biaya</a></li>
          </ul>
        </li>
        <li class="treeview <?php if ($page_name == 'penyewaan' || $page_name == 'pemasukan' || $page_name == 'pengeluaran' || $page_name == 'fee') echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-automobile"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page_name == 'penyewaan') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/penyewaan'?>"><i class="fa fa-circle-o"></i> Penyewaan Alat</a></li>
            <li class="<?php if ($page_name == 'pengeluaran') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/pengeluaran'?>"><i class="fa fa-circle-o"></i> Jurnal Harian (pengeluaran)</a></li>
            <li class="<?php if ($page_name == 'pemasukan') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/pemasukan'?>"><i class="fa fa-circle-o"></i> Data Pemasukan</a></li>
            <li class="<?php if ($page_name == 'fee') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/fee'?>"><i class="fa fa-circle-o"></i> Data Fee</a></li>
          </ul>
        </li>
        <li class="treeview <?php if ($page_name == 'lap_keuangan' || $page_name == 'lap_fee' || $page_name == 'lap_labarugi' || $page_name == 'lap_jurnal' || $page_name == 'lap_belanjatoko' || $page_name == 'lap_tanggunganpemilik' || $page_name == 'lap_penyewaanalat' || $page_name == 'lap_sparepart')echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page_name == 'lap_keuangan') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_keuangan'?>"><i class="fa fa-circle-o"></i> Laporan Keuangan</a></li>
            <li class="<?php if ($page_name == 'lap_labarugi') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_labarugi'?>"><i class="fa fa-circle-o"></i> Laporan Laba Rugi</a></li>
            <li class="<?php if ($page_name == 'lap_fee') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_fee'?>"><i class="fa fa-circle-o"></i> Laporan Penggunaan Fee</a></li>
            <li class="<?php if ($page_name == 'lap_jurnal') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_jurnal'?>"><i class="fa fa-circle-o"></i> Laporan Jurnal Harian</a></li>
            <li class="<?php if ($page_name == 'lap_belanjatoko') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_belanjatoko'?>"><i class="fa fa-circle-o"></i> Laporan Belanja Toko</a></li>
            <li class="<?php if ($page_name == 'lap_tanggunganpemilik') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_tanggunganpemilik'?>"><i class="fa fa-circle-o"></i> Laporan Tanggungan Pemilik</a></li>
            <li class="<?php if ($page_name == 'lap_penyewaanalat') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_penyewaanalat'?>"><i class="fa fa-circle-o"></i> Laporan Penyewaan Alat</a></li>
            <li class="<?php if ($page_name == 'lap_sparepart') echo 'active'; ?>"><a href="<?=base_url().'index.php/admin/lap_sparepart'?>"><i class="fa fa-circle-o"></i> Laporan Spare Part</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>