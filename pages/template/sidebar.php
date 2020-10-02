<aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php echo "<img src='images/".$_SESSION['foto']."'width='30' class='img-circle' height='30'>";?>
      </div>
      <div class="pull-left info">
        <p><?php echo "Admin" ;?></span></p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Menu</li>
      <li class="<?php if($halaman == 'Dashboard'){echo 'active';} ?> treeview">
        <a href="../">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="<?php if($halaman == 'buah' || $halaman == 'supplier' || $halaman == 'buah_kategori'){echo 'active';} ?> treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Fruit Mart</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($halaman == 'buah'){echo 'active';} ?> "><a href="buah.php"><i class="fa fa-circle-o"></i> Buah</a></li>
          <li class="<?php if($halaman == 'supplier'){echo 'active';} ?> "><a href="supplier.php"><i class="fa fa-circle-o"></i> Supplier</a></li>
          <li class="<?php if($halaman == 'buah_kategori'){echo 'active';} ?> "><a href="buah_kategori.php"><i class="fa fa-circle-o"></i> Kategori Buah</a></li>
        </ul>
      </li>            
        
        <li class="<?php if($halaman == 'admin'){echo 'active';} ?> treeview">
        <a href="pengguna.php">
          <i class="fa fa-user"></i> <span>Admin</span>
        </a>
      </li>
      <li class="<?php if($halaman == 'penjualan' || $halaman == 'penjualan_data'){echo 'active';} ?> treeview">
        <a href="#">
          <i class="fa fa-server"></i>
          <span>Transaksi</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($halaman == 'penjualan'){echo 'active';} ?> "><a href="penjualan.php"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          <li class="<?php if($halaman == 'penjualan_data'){echo 'active';} ?> "><a href="penjualan_data.php"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
        </ul>
      </li>
      <li class="<?php if($halaman == 'laporan'){echo 'active';} ?> treeview">
        <a href="laporan.php">
          <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
        </a>
      </li>
      <li class="treeview">
        <a href="cek_logout.php">
          <i class="fa fa-sign-out"></i> <span>Keluar</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>