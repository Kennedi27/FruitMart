<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "penjualan_data";

if(empty($_SESSION['user']) or empty($_SESSION['pass'] == 0)){
  header('location: login.php');
}else{
?>
<?php include 'template/header.php'; ?>
  <body class="skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px;">
      
     <?php include 'template/navigasi.php'; ?>

      <?php include 'template/sidebar.php'; ?>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="row"></div>
          <section class="content-header">
          <h1>
            Penjualan
            <small>Data Penjualan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
            <li>Data Penjualan</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Produk</h3>
                  <a href="penjualan.php" style="float: right;"><button class="btn btn-primary text-weight-bold">Tambah Data Penjualan</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No. Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Admin</th>
                        <th>Sub Total</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      include 'koneksi.php';
                      $no = 1;
                      $sql3 = "SELECT * FROM pembelian";
                      $query3 = mysqli_query($koneksi, $sql3);
                      while($data3 = mysqli_fetch_array($query3)){
                        $TotalHargaTransaksi = $data3['TotalHarga'];
                        $Pelanggan1 = $data3['pelanggan'];
                        if ($TotalHargaTransaksi == "") {
                          $TotalHargaTransaksi = 0;
                        }
                        if ($Pelanggan1 == "") {
                          $Pelanggan1 = "Tidak Ada Nama";
                        }
                    ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data3['No_Invoice']; ?></td>
                        <td><?php echo $data3['Tanggal_Invoice']; ?></td>
                        <td><?php echo $Pelanggan1; ?></td>
                        <td><?php echo $data3['admin']; ?></td>
                        <td><?php echo number_format($data3['SubHarga'], 2); ?></td>
                        <td><?php echo $data3['Diskon']." %"; ?></td>
                        <td><?php echo "Rp. ".number_format($TotalHargaTransaksi, 2); ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#detail_data_penjualan<?php echo $data3['No_Invoice']; ?>" title="Lihat Invoice"><button class="btn btn-success"><span class="ion ion-ios-search-strong "></span></button></a>
                          <a href="penjualan_edit.php?No_Invoice=<?php echo $data3['No_Invoice']; ?>" title="Edit Data penjualan"><button class="btn btn-warning"><span class="fa fa-pencil"></span></button></a>
                          <a data-toggle="modal" data-target="#hapus_data_penjualan<?php echo $data3['No_Invoice']; ?>" title="Hapus Data Penjualan"><button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
                        </td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section>
      </div>

  <?php include 'template/footer.php'; ?>
  <?php include 'form_proses.php';?>
<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
      });
    </script>
    <style type="text/css">
      footer {
        bottom: 0;
        position: fixed;
        width: 100%;
        margin-left: 0;
      }
    </style>
<?php } ?> 