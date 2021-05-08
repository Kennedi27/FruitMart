<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"SELECT * FROM user");
$halaman = "admin";

if(!empty($_SESSION['user']) or !empty($_SESSION['pass'])){
?>
<?php include 'template/header.php'; ?>

  <body class="skin-blue">
    <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px;">
      
      <?php include 'template/navigasi.php'; ?>

      <?php include 'template/sidebar.php'; ?>
      <div class="content-wrapper">
        <div class="row"></div>
          <section class="content-header">
          <h1>
            Admin
            <small>Data Admin</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Page</li>
            <li>Admin</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Admin</h3>
                  <a data-toggle="modal" data-target="#tambah_pengguna" style="float: right;"><button class="btn btn-primary text-weight-bold">Tambah Data Admin</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat / Tanggal Lahir</th>
                        <th>Username</th>
                        <th>Foto</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        while ($data = mysqli_fetch_array($sql)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['Nama']; ?></td>
                        <td><?php echo $data['Alamat']; ?></td>
                        <td><?php echo $data['Jenis_Kelamin']; ?></td>
                        <td><?php echo $data['Tempat'].", ".$data['Tanggal']; ?></td>
                        <td><?php echo $data['Username']; ?></td>
                        <td><?php echo $data['Foto']; ?></td>
                        <td>
                          <a data-toggle="modal" data-target="#edit_pengguna<?php echo $data['ID']; ?>"><button class="btn btn-info"><span class="fa fa-pencil"></span> Edit</button></a>
                          <a data-toggle="modal" data-target="#hapus_pengguna<?php echo $data['ID']; ?>"><button class="btn btn-danger"><span class="fa fa-trash"></span> Hapus</button></a>
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
<?php include 'form_proses.php'; ?>

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
    margin-left: 0;
    bottom: 0;
    position: fixed;
  }
</style>
<?php
}else{
    header('location: login.php');
}
?>