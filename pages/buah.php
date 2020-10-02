<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "buah";

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
        <!-- Content Header (Page header) -->
        <div class="row">
          <section class="content-header">
            <h1 style="margin-left: 20px;">
              Buah
              <small>Data Buah</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Pages</li>
              <li>Buah</li>
            </ol>
          </section>
        </div>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Buah</h3>
                  <a data-toggle="modal" data-target="#tambah_buah" style="float: right;"><button class="btn btn-primary text-weight-bold">Tambah Data Buah</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama Buah</th>
                        <th>Satuan</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Modal</th>
                        <th>Jual</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        $sql1 = mysqli_query($koneksi, "SELECT P.*, K.Nama_Kategori AS Nama_Kat FROM buah P, kategori_buah K WHERE P.KategoriID = K.KategoriID");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data1['Kd_Buah']; ?></td>
                        <td><?php echo $data1['Nama']; ?></td>
                        <td><?php echo $data1['Satuan']; ?></td>
                        <td><?php echo $data1['Nama_Kat']; ?></td>
                        <td><?php echo $data1['Stok']; ?></td>
                        <td><?php echo "Rp. ".number_format($data1['Harga_Modal'], 2); ?></td>
                        <td><?php echo "Rp. ".number_format($data1['Harga_Jual'], 2); ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#edit_buah<?php echo $data1['Kd_Buah'] ?>"><button class="btn btn-info"><span class="fa fa-pencil"></span> Edit</button></a>
                          <a data-toggle="modal" data-target="#hapus_buah<?php echo $data1['Kd_Buah'] ?>"><button class="btn btn-danger"><span class="fa fa-trash"></span> Hapus</button></a>
                        </td>
                      </tr>
                    <?php } ?>
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
    width: 100%;
    bottom: 0;
    position: fixed;
    margin-left: 0;
  }
</style>
<?php } ?>