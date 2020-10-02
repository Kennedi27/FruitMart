<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "Dashboard";

if(empty($_SESSION['user']) or empty($_SESSION['pass'] == 0)){
  header('location: login.php');
}else{
?>
<?php include 'template/header.php'; ?>
<body class="skin-blue">
  <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px;">
    
  <?php include 'template/navigasi.php'; ?>

  <?php include 'template/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      <?php

      // Data Harian
        $harian = mysqli_query($koneksi, "SELECT SUM(TotalHarga) as penjualan_hari_ini FROM pembelian WHERE Tanggal_Invoice = DATE(NOW())");
        $penjualan_Harian = mysqli_fetch_array($harian);

        $harian2 = mysqli_query($koneksi, "SELECT HargaModal, Qty FROM join_buah WHERE Tanggal_Invoice = DATE(NOW())");
        $total_modal_harian = 0;
        while($Modal_Harian = mysqli_fetch_array($harian2)){
            $hargaSatuan = $Modal_Harian['HargaModal'];
            $jumlahProduk = $Modal_Harian['Qty'];
            $prosesModal = $hargaSatuan * $jumlahProduk;
            $total_modal_harian = $total_modal_harian + $prosesModal;
        }
        $tampil_penjualan_hari_ini = $penjualan_Harian['penjualan_hari_ini'];
        $laba_Harian = 0;
          if ($tampil_penjualan_hari_ini == "") {
            $tampil_penjualan_hari_ini = 0;
            $laba_Harian = 0;
          }else{
            $tampil_penjualan_hari_ini = $penjualan_Harian['penjualan_hari_ini'];
            $laba_Harian = $tampil_penjualan_hari_ini - $total_modal_harian;
          }
        //Penutup Data Harian

          // Data Bulanan
          $bulanan = mysqli_query($koneksi, "SELECT SUM(TotalHarga) as penjualan_bulan_ini FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', MONTH(NOW()))");
          $penjualan_bulanan = mysqli_fetch_array($bulanan);

          $bulanan1 = mysqli_query($koneksi, "SELECT HargaModal, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', MONTH(NOW()))");
          $total_modal_bulanan = 0;
          while($modal_bulanan = mysqli_fetch_array($bulanan1)){
            $hargaSatuan2 = $modal_bulanan['HargaModal'];
            $jumlahProduk2 = $modal_bulanan['Qty'];
            $prosesModal2 = $hargaSatuan2 * $jumlahProduk2;
            $total_modal_bulanan = $total_modal_bulanan + $prosesModal2;
          }

          $data_penjualan_bulanan = $penjualan_bulanan['penjualan_bulan_ini'];
          $laba_bulanan = 0;

          if ($data_penjualan_bulanan == "") {
            $data_penjualan_bulanan = 0;
          }else{
            $data_penjualan_bulanan = $penjualan_bulanan['penjualan_bulan_ini'];
            $laba_bulanan = $data_penjualan_bulanan - $total_modal_bulanan;
          }
          // Data Bulanan End

          // Data Tahunan
          $tahunan = mysqli_query($koneksi, "SELECT SUM(TotalHarga) as penjualan_tahun_ini FROM pembelian WHERE YEAR(Tanggal_Invoice) = YEAR(NOW())");
          $penjualan_tahunan = mysqli_fetch_array($tahunan);

          $tahunan1 = mysqli_query($koneksi, "SELECT HargaModal, Qty FROM join_buah WHERE YEAR(Tanggal_Invoice) = YEAR(NOW())");
          $total_modal_tahunan = 0;
          while($modal_tahunan = mysqli_fetch_array($tahunan1)){
            $hargaSatuan3 = $modal_tahunan['HargaModal'];
            $jumlahProduk3 = $modal_tahunan['Qty'];
            $prosesModal3 = $hargaSatuan3 * $jumlahProduk3;
            $total_modal_tahunan = $total_modal_tahunan + $prosesModal3;
          }

          $data_penjualan_tahunan = $penjualan_tahunan['penjualan_tahun_ini'];
          $laba_tahunan = 0;

          if ($data_penjualan_tahunan == "") {
            $data_penjualan_tahunan = 0;
          }else{
            $data_penjualan_tahunan = $penjualan_tahunan['penjualan_tahun_ini'];
            $laba_tahunan = $data_penjualan_tahunan - $total_modal_tahunan;
          }
          // Data Tahunan End

          // Semua Data
          $semuaData = mysqli_query($koneksi, "SELECT SUM(TotalHarga) as penjualan_semua_data FROM pembelian");
          $semuaData_penjualan = mysqli_fetch_array($semuaData);

          $semuaData1 = mysqli_query($koneksi, "SELECT HargaModal, Qty FROM join_buah");
          $total_semua_modal = 0;
          while ($semuaDataModal = mysqli_fetch_array($semuaData1)) {
            $hargaSatuan4 = $semuaDataModal['HargaModal'];
            $jumlahProduk4 = $semuaDataModal['Qty'];
            $prosesModal4 = $hargaSatuan4 * $jumlahProduk4;
            $total_semua_modal = $total_semua_modal + $prosesModal4;
          }

          $penjualan_semua_data = $semuaData_penjualan['penjualan_semua_data'];
          $semuaLaba = $penjualan_semua_data - $total_semua_modal;
          // Semua Data End

      ?>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($tampil_penjualan_hari_ini, 2); ?>
              </h4>
              <p>
                Penjualan Hari Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($data_penjualan_bulanan, 2); ?>
              </h4>
              <p>
                Penjualan Bulan Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($data_penjualan_tahunan, 2); ?>
              </h4>
              <p>
                Penjualan Tahun Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($penjualan_semua_data, 2); ?>
              </h4>
              <p>
                Total Seluruh Penjualan
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
      </div><!-- /.row -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($laba_Harian, 2); ?>
              </h4>
              <p>
                Laba Hari Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($laba_bulanan, 2); ?>
              </h4>
              <p>
                Laba Bulan Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-briefcase-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($laba_tahunan, 2); ?>
              </h4>
              <p>
                Laba Tahun Ini
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-alarm-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h4 style="font-weight: bold; font-size: 20pt;">
                <?php echo "Rp. ".number_format($semuaLaba, 2); ?>
              </h4>
              <p>
                Total Seluruh Laba
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-pricetag-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
               
            </a>
          </div>
        </div>
      </div>
        <!-- ./col -->
        <!-- Ketersediaan and Data Buah -->
        <div class="row">
          <div class="col-md-7">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Ketersediaan Buah</h3>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                      <th>Kode Buah</th>
                      <th>Nama Buah</th>
                      <th>Nama Supplier</th>
                      <th>Jumlah  Stok</th>
                    </thead>
                    <tbody>
                    <?php
                      $tersedia = mysqli_query($koneksi, "SELECT buah.Kd_Buah, buah.Nama, buah.Stok, sup.Nama as sup_nama FROM buah buah, supplier sup WHERE buah.SupplierID = sup.SupplierID ORDER BY buah.Stok LIMIT 10");
                      while($gudang = mysqli_fetch_array($tersedia)){
                    ?>
                    <tr>
                      <td><?php echo $gudang['Kd_Buah']; ?></td>
                      <td><?php echo $gudang['Nama']; ?></td>
                      <td><?php echo $gudang['sup_nama']; ?></td>
                      <td><?php echo $gudang['Stok']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Buah Terlaris</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div><!-- /.box-header -->
       
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                    <tr>
                      <th>Nama Buah</th>
                      <th>Total Terjual</th>
                      <th>Total Pendapatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $terlaris = mysqli_query($koneksi, "SELECT buah.Nama,  SUM(detail.Qty) as totalterjual, SUM(detail.TotalHargaPerProduk) as totalpendapatan FROM detail_pembelian detail, buah buah WHERE detail.Kd_Buah = buah.Kd_Buah GROUP BY buah.Kd_Buah ORDER BY totalterjual DESC LIMIT 10");
                      while($laris = mysqli_fetch_array($terlaris)){
                    ?>
                      <tr>
                        <td><?php echo $laris['Nama']; ?></td>
                        <td><?php echo $laris['totalterjual']; ?></td>
                        <td><?php echo "Rp. ".number_format($laris['totalpendapatan'], 2); ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="supplier.php" class="btn btn-sm btn-default btn-flat pull-right">Lihat Lainnya</a>
            </div><!-- /.box-footer -->
          </div>
          </div>
        </div>
        <!-- Grafik and Suppier -->
        <div class="row">
          <div class="col-md-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Statistik Laba & rugi</h3>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
              </div>
            </div>
          </div>

        <div class="col-md-5">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Data Supplier Terbaru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div><!-- /.box-header -->
       
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Telp</th>
                      <th>Alamat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $suplai = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY Nama ASC LIMIT 7");
                      while($suplier1 = mysqli_fetch_array($suplai)){
                    ?>
                      <tr>
                        <td><?php echo $suplier1['Nama']; ?></td>
                        <td><?php echo $suplier1['NoTelp']; ?></td>
                        <td><?php echo $suplier1['Alamat']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="supplier.php" class="btn btn-sm btn-default btn-flat pull-right">Lihat Lainnya</a>
            </div><!-- /.box-footer -->
          </div><!-- /.box -->
        </div>
      </div>
    </section>
  </div>
<?php 
  
  $query_jan = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 1)");
  $totalPenjualan_jan = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_Jan FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 1)");
  $DataPenjualan_jan = mysqli_fetch_array($totalPenjualan_jan);
  $total_modal_jan = 0;
  while ($modal_jan = mysqli_fetch_array($query_jan)) {
    $hargaSatuan_jan = $modal_jan['Harga'];
    $jumlahProduk_jan = $modal_jan['Qty'];
    $prosesModal_jan = $hargaSatuan_jan * $jumlahProduk_jan;
    $total_modal_jan = $total_modal_jan + $prosesModal_jan;
  }
  $TotalHarga_Jan = $DataPenjualan_jan['TotalHarga_Jan'];
  $Laba_jan = $TotalHarga_Jan - $total_modal_jan;
  $Rugi_jan = $total_modal_jan - $TotalHarga_Jan;

  if ($Laba_jan <= 0 || $total_modal_jan == 0) {
    $Laba_jan = 0;
  }else{
    $Laba_jan = $Laba_jan;
  }

  if ($Rugi_jan >= 0) {
    $Rugi_jan = $Rugi_jan;
  }else{
    $Rugi_jan = 0;
  }

  $query_feb = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 2)");
  $totalPenjualan_feb = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_feb FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 2)");
  $DataPenjualan_feb = mysqli_fetch_array($totalPenjualan_feb);
  $total_modal_feb = 0;
  while ($modal_feb = mysqli_fetch_array($query_feb)) {
    $hargaSatuan_feb = $modal_feb['Harga'];
    $jumlahProduk_feb = $modal_feb['Qty'];
    $prosesModal_feb = $hargaSatuan_feb * $jumlahProduk_feb;
    $total_modal_feb = $total_modal_feb + $prosesModal_feb;
  }
  $TotalHarga_feb = $DataPenjualan_feb['TotalHarga_feb'];
  $Laba_feb = $TotalHarga_feb - $total_modal_feb;
  $Rugi_feb = $total_modal_feb - $TotalHarga_feb;

  if ($Laba_feb <= 0 || $total_modal_feb == 0) {
    $Laba_feb = 0;
  }else{
    $Laba_feb = $Laba_feb;
  }

  if ($Rugi_feb >= 0) {
    $Rugi_feb = $Rugi_feb;
  }else{
    $Rugi_feb = 0;
  }

  $query_mar = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 3)");
  $totalPenjualan_mar = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_mar FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 3)");
  $DataPenjualan_mar = mysqli_fetch_array($totalPenjualan_mar);
  $total_modal_mar = 0;
  while ($modal_mar = mysqli_fetch_array($query_mar)) {
    $hargaSatuan_mar = $modal_mar['Harga'];
    $jumlahProduk_mar = $modal_mar['Qty'];
    $prosesModal_mar = $hargaSatuan_mar * $jumlahProduk_mar;
    $total_modal_mar = $total_modal_mar + $prosesModal_mar;
  }
  $TotalHarga_mar = $DataPenjualan_mar['TotalHarga_mar'];
  $Laba_mar = $TotalHarga_mar - $total_modal_mar;
  $Rugi_mar = $total_modal_mar - $TotalHarga_mar;

  if ($Laba_mar <= 0 || $total_modal_mar == 0) {
    $Laba_mar = 0;
  }else{
    $Laba_mar = $Laba_mar;
  }

  if ($Rugi_mar >= 0) {
    $Rugi_mar = $Rugi_mar;
  }else{
    $Rugi_mar = 0;
  }

  $query_apr = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 4)");
  $totalPenjualan_apr = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_apr FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 4)");
  $DataPenjualan_apr = mysqli_fetch_array($totalPenjualan_apr);
  $total_modal_apr = 0;
  while ($modal_apr = mysqli_fetch_array($query_apr)) {
    $hargaSatuan_apr = $modal_apr['Harga'];
    $jumlahProduk_apr = $modal_apr['Qty'];
    $prosesModal_apr = $hargaSatuan_apr * $jumlahProduk_apr;
    $total_modal_apr = $total_modal_apr + $prosesModal_apr;
  }
  $TotalHarga_apr = $DataPenjualan_apr['TotalHarga_apr'];
  $Laba_apr = $TotalHarga_apr - $total_modal_apr;
  $Rugi_apr = $total_modal_apr - $TotalHarga_apr;

  if ($Laba_apr <= 0 || $total_modal_apr == 0) {
    $Laba_apr = 0;
  }else{
    $Laba_apr = $Laba_apr;
  }

  if ($Rugi_apr >= 0) {
    $Rugi_apr = $Rugi_apr;
  }else{
    $Rugi_apr = 0;
  }

  $query_mei = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 5)");
  $totalPenjualan_mei = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_mei FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 5)");
  $DataPenjualan_mei = mysqli_fetch_array($totalPenjualan_mei);
  $total_modal_mei = 0;
  while ($modal_mei = mysqli_fetch_array($query_mei)) {
    $hargaSatuan_mei = $modal_mei['Harga'];
    $jumlahProduk_mei = $modal_mei['Qty'];
    $prosesModal_mei = $hargaSatuan_mei * $jumlahProduk_mei;
    $total_modal_mei = $total_modal_mei + $prosesModal_mei;
  }
  $TotalHarga_mei = $DataPenjualan_mei['TotalHarga_mei'];
  $Laba_mei = $TotalHarga_mei - $total_modal_mei;
  $Rugi_mei = $total_modal_mei - $TotalHarga_mei;

  if ($Laba_mei <= 0 || $total_modal_mei == 0) {
    $Laba_mei = 0;
  }else{
    $Laba_mei = $Laba_mei;
  }

  if ($Rugi_mei >= 0) {
    $Rugi_mei = $Rugi_mei;
  }else{
    $Rugi_mei = 0;
  }

  $query_juni = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 6)");
  $totalPenjualan_juni = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_juni FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 6)");
  $DataPenjualan_juni = mysqli_fetch_array($totalPenjualan_juni);
  $total_modal_juni = 0;
  while ($modal_juni = mysqli_fetch_array($query_juni)) {
    $hargaSatuan_juni = $modal_juni['Harga'];
    $jumlahProduk_juni = $modal_juni['Qty'];
    $prosesModal_juni = $hargaSatuan_juni * $jumlahProduk_juni;
    $total_modal_juni = $total_modal_juni + $prosesModal_juni;
  }
  $TotalHarga_juni = $DataPenjualan_juni['TotalHarga_juni'];
  $Laba_juni = $TotalHarga_juni - $total_modal_juni;
  $Rugi_juni = $total_modal_juni - $TotalHarga_juni;

  if ($Laba_juni <= 0 || $total_modal_juni == 0) {
    $Laba_juni = 0;
  }else{
    $Laba_juni = $Laba_juni;
  }

  if ($Rugi_juni >= 0) {
    $Rugi_juni = $Rugi_juni;
  }else{
    $Rugi_juni = 0;
  }

  $query_juli = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 7)");
  $totalPenjualan_juli = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_juli FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 7)");
  $DataPenjualan_juli = mysqli_fetch_array($totalPenjualan_juli);
  $total_modal_juli = 0;
  while ($modal_juli = mysqli_fetch_array($query_juli)) {
    $hargaSatuan_juli = $modal_juli['Harga'];
    $jumlahProduk_juli = $modal_juli['Qty'];
    $prosesModal_juli = $hargaSatuan_juli * $jumlahProduk_juli;
    $total_modal_juli = $total_modal_juli + $prosesModal_juli;
  }
  $TotalHarga_juli = $DataPenjualan_juli['TotalHarga_juli'];
  $Laba_juli = $TotalHarga_juli - $total_modal_juli;
  $Rugi_juli = $total_modal_juli - $TotalHarga_juli;

  if ($Laba_juli <= 0 || $total_modal_juli == 0) {
    $Laba_juli = 0;
  }else{
    $Laba_juli = $Laba_juli;
  }

  if ($Rugi_juli >= 0) {
    $Rugi_juli = $Rugi_juli;
  }else{
    $Rugi_juli = 0;
  }

  $query_agust = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 8)");
  $totalPenjualan_agust = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_agust FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 8)");
  $DataPenjualan_agust = mysqli_fetch_array($totalPenjualan_agust);
  $total_modal_agust = 0;
  while ($modal_agust = mysqli_fetch_array($query_agust)) {
    $hargaSatuan_agust = $modal_agust['Harga'];
    $jumlahProduk_agust = $modal_agust['Qty'];
    $prosesModal_agust = $hargaSatuan_agust * $jumlahProduk_agust;
    $total_modal_agust = $total_modal_agust + $prosesModal_agust;
  }
  $TotalHarga_agust = $DataPenjualan_agust['TotalHarga_agust'];
  $Laba_agust = $TotalHarga_agust - $total_modal_agust;
  $Rugi_agust = $total_modal_agust - $TotalHarga_agust;

  if ($Laba_agust <= 0 || $total_modal_agust == 0) {
    $Laba_agust = 0;
  }else{
    $Laba_agust = $Laba_agust;
  }

  if ($Rugi_agust >= 0) {
    $Rugi_agust = $Rugi_agust;
  }else{
    $Rugi_agust = 0;
  }

  $query_sept = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 9)");
  $totalPenjualan_sept = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_sept FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 9)");
  $DataPenjualan_sept = mysqli_fetch_array($totalPenjualan_sept);
  $total_modal_sept = 0;
  while ($modal_sept = mysqli_fetch_array($query_sept)) {
    $hargaSatuan_sept = $modal_sept['Harga'];
    $jumlahProduk_sept = $modal_sept['Qty'];
    $prosesModal_sept = $hargaSatuan_sept * $jumlahProduk_sept;
    $total_modal_sept = $total_modal_sept + $prosesModal_sept;
  }
  $TotalHarga_sept = $DataPenjualan_sept['TotalHarga_sept'];
  $Laba_sept = $TotalHarga_sept - $total_modal_sept;
  $Rugi_sept = $total_modal_sept - $TotalHarga_sept;

  if ($Laba_sept <= 0 || $total_modal_sept == 0) {
    $Laba_sept = 0;
  }else{
    $Laba_sept = $Laba_sept;
  }

  if ($Rugi_sept >= 0) {
    $Rugi_sept = $Rugi_sept;
  }else{
    $Rugi_sept = 0;
  }

  $query_okt = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 10)");
  $totalPenjualan_okt = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_okt FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 10)");
  $DataPenjualan_okt = mysqli_fetch_array($totalPenjualan_okt);
  $total_modal_okt = 0;
  while ($modal_okt = mysqli_fetch_array($query_okt)) {
    $hargaSatuan_okt = $modal_okt['Harga'];
    $jumlahProduk_okt = $modal_okt['Qty'];
    $prosesModal_okt = $hargaSatuan_okt * $jumlahProduk_okt;
    $total_modal_okt = $total_modal_okt + $prosesModal_okt;
  }
  $TotalHarga_okt = $DataPenjualan_okt['TotalHarga_okt'];
  $Laba_okt = $TotalHarga_okt - $total_modal_okt;
  $Rugi_okt = $total_modal_okt - $TotalHarga_okt;

  if ($Laba_okt <= 0 || $total_modal_okt == 0) {
    $Laba_okt = 0;
  }else{
    $Laba_okt = $Laba_okt;
  }

  if ($Rugi_okt >= 0) {
    $Rugi_okt = $Rugi_okt;
  }else{
    $Rugi_okt = 0;
  }

  $query_nov = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 11)");
  $totalPenjualan_nov = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_nov FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 2)");
  $DataPenjualan_nov = mysqli_fetch_array($totalPenjualan_nov);
  $total_modal_nov = 0;
  while ($modal_nov = mysqli_fetch_array($query_nov)) {
    $hargaSatuan_nov = $modal_nov['Harga'];
    $jumlahProduk_nov = $modal_nov['Qty'];
    $prosesModal_nov = $hargaSatuan_nov * $jumlahProduk_nov;
    $total_modal_nov = $total_modal_nov + $prosesModal_nov;
  }
  $TotalHarga_nov = $DataPenjualan_nov['TotalHarga_nov'];
  $Laba_nov = $TotalHarga_nov - $total_modal_nov;
  $Rugi_nov = $total_modal_nov - $TotalHarga_nov;

  if ($Laba_nov <= 0 || $total_modal_nov == 0) {
    $Laba_nov = 0;
  }else{
    $Laba_nov = $Laba_nov;
  }

  if ($Rugi_nov >= 0) {
    $Rugi_nov = $Rugi_nov;
  }else{
    $Rugi_nov = 0;
  }

  $query_des = mysqli_query($koneksi, "SELECT HargaModal as Harga, Qty FROM join_buah WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 12)");
  $totalPenjualan_des = mysqli_query($koneksi, "SELECT SUM(TotalHarga) AS TotalHarga_des FROM pembelian WHERE CONCAT(YEAR(Tanggal_Invoice), '/', MONTH(Tanggal_Invoice)) = CONCAT(YEAR(NOW()), '/', 2)");
  $DataPenjualan_des = mysqli_fetch_array($totalPenjualan_des);
  $total_modal_des = 0;
  while ($modal_des = mysqli_fetch_array($query_des)) {
    $hargaSatuan_des = $modal_des['Harga'];
    $jumlahProduk_des = $modal_des['Qty'];
    $prosesModal_des = $hargaSatuan_des * $jumlahProduk_des;
    $total_modal_des = $total_modal_des + $prosesModal_des;
  }
  $TotalHarga_des = $DataPenjualan_des['TotalHarga_des'];
  $Laba_des = $TotalHarga_des - $total_modal_des;
  $Rugi_des = $total_modal_des - $TotalHarga_des;

  if ($Laba_des <= 0 || $total_modal_des == 0) {
    $Laba_des = 0;
  }else{
    $Laba_des = $Laba_des;
  }

  if ($Rugi_des >= 0) {
    $Rugi_des = $Rugi_des;
  }else{
    $Rugi_des = 0;
  }


?>
<?php include 'template/footer.php'; ?>
<script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="aas.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function () {
  "use strict";
  var line = new Morris.Line({
    element: 'line-chart',
    resize: true,
    data: [
      {y: 'Jan', laba: <?php echo $Laba_jan; ?>, rugi: <?php echo $Rugi_jan; ?>},
      {y: 'Feb', laba: <?php echo $Laba_feb; ?>, rugi: <?php echo $Rugi_feb; ?>},
      {y: 'Mar', laba: <?php echo $Laba_mar; ?>, rugi: <?php echo $Rugi_mar; ?>},
      {y: 'Apr', laba: <?php echo $Laba_apr; ?>, rugi: <?php echo $Rugi_apr; ?>},
      {y: 'Mei', laba: <?php echo $Laba_mei; ?>, rugi: <?php echo $Rugi_mei; ?>},
      {y: 'Juni', laba: <?php echo $Laba_juni; ?>, rugi: <?php echo $Rugi_juni; ?>},
      {y: 'Juli', laba: <?php echo $Laba_juli; ?>, rugi: <?php echo $Rugi_juli; ?>},
      {y: 'Agust', laba: <?php echo $Laba_agust; ?>, rugi: <?php echo $Rugi_agust; ?>},
      {y: 'Sept', laba: <?php echo $Laba_sept; ?>, rugi: <?php echo $Rugi_sept; ?>},
      {y: 'Okt', laba: <?php echo $Laba_okt; ?>, rugi: <?php echo $Rugi_okt; ?>},
      {y: 'Nov', laba: <?php echo $Laba_nov; ?>, rugi: <?php echo $Rugi_nov; ?>},
      {y: 'Des', laba: <?php echo $Laba_des; ?>, rugi: <?php echo $Rugi_des; ?>}
    ],
    xkey: 'y',
    ykeys: ['laba', 'rugi'],
    labels: ['Januari', 'February', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    lineColors: ['green', 'red'],
    parseTime: false,
    hideHover: true,
    stacked: true
  });
});
</script>
<?php } ?>