<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "laporan";

if(!empty($_SESSION['user']) or !empty($_SESSION['pass'])){
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
            Laporan
            <small>Laporan Penjualan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Page</li>
            <li>Laporan</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Filter Laporan Penjualan</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="padding-bottom: 30px;">
                  <form action="laporan_tampil.php" id="form_laporan" method="post">
                    <table border="0" width="500">
                      <tr>
                        <td><label class="label-control">Mulai Tanggal :</label></td>
                        <td><label class="label-control">Sampai Dengan :</label></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><input type="date" required name="laporan_tanggaldari" class="form-control" style="width: 90%;"></td>
                        <td><input type="date" name="laporan_tanggalke" class="form-control" style="width: 90%;"></td>
                        <td><button type="submit" class="btn btn-info" style="font-weight: bold;">Tampilkan</button></td>
                      </tr>
                    </table>
                  </form>
                </div>
              </div>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Penjualan</h3>
                </div>
                <div class="box-body">
                  <table class="table" border="0" style="width: 300px;">
                    <tr>
                      <td><label class="label-control">Dari Tanggal :</label></td>
                      <td><b id="b_daritanggal">-</b> </td>
                    </tr>
                    <tr>
                      <td><label class="label-control">Ke Tanggal :</label></td>
                      <td><b id="b_ketanggal">-</b></td>
                    </tr>
                  </table>
                  <center id="bilatidakada"><h2><b>Tidak Dapat Menampilkan Laporan </b></h2><br><b>Mohon Untuk Memasukkan Tanggal Agar Dapat Di Proses</b></center>
                  <div id="datatampil"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section>
      </div>

    <?php include 'template/footer.php'; ?>
    <script type="text/javascript" src="../plugins/datatables/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../plugins/datatables/Buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../plugins/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../plugins/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="../plugins/datatables/Buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../plugins/datatables/Buttons/js/buttons.print.min.js"></script>
    




<script type="text/javascript">
  $(document).ready(function() {
    tampilkan_laporan();
  })
  function tampilkan_laporan() {
    $('#form_laporan').on('submit', function(e) {
      e.preventDefault();
      var tglke = $('input[name=laporan_tanggalke]').val();
      if (tglke == "") {tglke = $('input[name=laporan_tanggaldari]').val()}
      $.ajax({
        type : $(this).attr('method'),
        url : $(this).attr('action'),
        data : $(this).serialize(),
        success : function(respond) {
          $('#datatampil').html(respond);
          document.getElementById('b_daritanggal').innerHTML = $('input[name=laporan_tanggaldari]').val();
          document.getElementById('b_ketanggal').innerHTML = tglke;
          document.getElementById('bilatidakada').style.display = "none";
        }
      })
    })
  }
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