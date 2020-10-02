<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "buah_kategori";

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
        <div class="row"></div>
        <section class="content-header">
          <h1>
            Buah
            <small>Kategori</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Buah</li>
            <li>Kategori</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Kategori Buah</h3>
                  <a data-toggle="modal" data-target="#tambah_kat_buah" style="float: right;"><button class="btn btn-primary text-weight-bold">Tambah Kategori Buah</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        $sql2 = mysqli_query($koneksi, "SELECT * FROM kategori_buah");
                        while ($data2 = mysqli_fetch_array($sql2)) {
                        
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data2['KategoriID']; ?></td>
                        <td><?php echo $data2['Nama_Kategori']; ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#edit_kat_buah<?php echo $data2['KategoriID']; ?>"><button class="btn btn-info"><span class="fa fa-pencil"></span> Edit</button></a>
                          <a data-toggle="modal" data-target="#hapus_kat_buah<?php echo $data2['KategoriID']; ?>"><button class="btn btn-danger"><span class="fa fa-trash"></span> Hapus</button></a>
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
    margin-left: 0;
    position: fixed;
  }
</style>
<?php } ?>