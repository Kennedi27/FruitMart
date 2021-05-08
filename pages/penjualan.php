<?php
session_start();
$akses=$_SESSION['user'];
include 'koneksi.php';
$sql = mysqli_query($koneksi,"select * from user");
$halaman = "penjualan";

if(!empty($_SESSION['user']) or !empty($_SESSION['pass'])){
?>
<?php 
error_reporting(0);
  include 'koneksi.php';
  $id = $_GET['id'];
  if($id == ""){
    $id = "B0001";
  }
?>
    <?php
      include 'template/header.php';
    ?>
    
<body class="skin-blue sidebar-mini sidebar-collapse">
  <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px;">    

    <?php 
      include 'template/navigasi.php';
      include 'template/sidebar.php';
    ?>

    <!-- Content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="row"></div>
        <section class="content-header">
          <h1>
            Penjualan
            <small>Tambah Penjualan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Page</li>
            <li>Penjualan</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tambah Penjualan</h3>
                  <a href="penjualan_data.php" style="float: right;"><button class="btn btn-primary text-weight-bold">Data penjualan</button></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_tambah_per_buah.php" id="form" method="post">
                    <div class="row">
                      <div class="col-md-3">
                        <label class="label-control">Admin:</label><br>
                        <input type="text" name="admin2" disabled="disabled" value="<?php echo $_SESSION['name']; ?>" class="form-control">
                        <input type="hidden" name="admin" value="<?php echo $_SESSION['name']; ?>">
                      </div>
                      <?php
                        $query0 = mysqli_query($koneksi, "SELECT max(No_Invoice) as kodemax FROM pembelian");
                        $data01 = mysqli_fetch_array($query0);
                        $data02 = $data01['kodemax'];
                        $urutan = (int) substr($data02, 2, 4);

                        $urutan++;
                        $huruf01 = "IV";
                        $data02 = $huruf01.sprintf("%04s", $urutan);
                      ?>
                      <div class="col-md-3">
                        <label class="label-control">No. Invoice</label><br>
                        <input type="text" name="no_invoice1" id="no_invoice1" value="<?php echo $data02; ?>" disabled="disabled" class="form-control">
                        <input type="hidden" name="no_invoice" id="no_invoice" value="<?php echo $data02; ?>">
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">Tanggal Invoice</label><br>
                        <input type="text" name="tanggal_invoice2" disabled="disabled" value="<?php echo date('Y-m-d') ?>" class="form-control">
                        <input type="hidden" name="tanggal_invoice" value="<?php echo date('Y-m-d') ?>">
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">Pelanggan</label><br>
                        <input type="text" name="pelanggan" placeholder="Nama Customer" class="form-control">
                      </div>
                    </div>

                    <div class="row" style="padding-top: 40px;">
                      <div class="col-md-3">
                        <h4><b>Tambah Pembelian</b></h4>  
                    <?php
                      $sql = mysqli_query($koneksi, "SELECT * FROM buah WHERE Kd_Buah = '$id'");
                      while ($data = mysqli_fetch_array($sql)) {
                        $id_buah = $data['Kd_Buah'];
                        $nama_buah = $data['Nama'];
                        $harga_buah = number_format($data['Harga_Jual'],2);
                    ?>
                        <div class="form-group">
                          <label class="label-control">Kode buah</label><br>
                          <input type="text" name="Kd_Buah" class="form-control" required style="width: 50%; float: left;">
                          <a data-toggle="modal" data-target="#cari_buah_penjualan"><button class="btn btn-success" style="float: right;"><span class="ion ion-android-search"></span> Cari buah</button></a>
                        </div><br>
                        <div class="form-group">
                          <label class="label-control" style="padding-top: 20px; padding-left: 0; margin-left: 0;">buah : </label>
                          <input type="text" name="nama" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                          <label class="label-control">Harga :</label>
                          <input type="text" name="harga" id="harga" class="form-control" disabled>
                          <input type="hidden" name="harga2" id="harga2">
                        </div>
                        <div class="form-group">
                          <label class="label-control">Jumlah :</label>
                          <input type="number" name="jumlah" value="1" onclick="total_harga()" required onkeyup="total_harga();" id="jumlah" class="form-control">
                        </div>
                        <script type="text/javascript">
                          function total_harga() {
                            var jumlah, total, harga, hasil;
                            jumlah = document.getElementById('jumlah').value;
                            harga = document.getElementById('harga2').value;
                            hasil = parseFloat(harga) * parseFloat(jumlah);
                             if (!isNaN(hasil)) {
                              document.getElementById('total').value = hasil;
                             }else{
                                document.getElementById('total').value = 0;
                             }

                          }
                        </script>
                        <div class="form-group">
                          <label class="label-control">Total :</label>
                          <input type="text" name="total" id="total" class="form-control">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submit" class="btn btn-success form-control" value="Tambahkan">
                        </div>
                      <?php
                        }
                      ?>
                      </div>
                    </form>
                  
                      <div class="col-md-9">
                        <h4><b>Daftar Pembelian</b></h4>
                          <div class="alertSukses">
                            <b id="alertSukses"></b>
                          </div>
                        <div id="beli_dong"></div>
                          <button id="tambah_transaksi" class="btn btn-success" style="float: right; font-weight: bold;"><span class="ion ion-checkmark"></span> Tambah Transaksi</button>

                      </div>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
        </div>
      </section>
    </div>
              

    <?php 
      include 'template/footer.php';
    ?>
    <?php
      include 'form_proses.php';
    ?>

    <!-- Data Table plus Ajax -->
    <script type="text/javascript">
     $(document).ready(function(){
        loadData();
        $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
          type: $(this).attr('method'),
          url : $(this).attr('action'),
          data: $(this).serialize(),
          success : function(respond){
            loadData();
            $('#alertSukses').html(respond);
            $(".alertSukses").fadeIn(1000, function(){
            $('.alertSukses').slideUp(4000);
            document.getElementById('tambah_transaksi').style.display = "block";
            });
          }
        });
        })

      tambahDataTransaksi();

      // Add buah to List
      $('.tambah_data_penjualan').click(function(e) {
      e.preventDefault();
      $('[name=Kd_Buah]').val($(this).attr('Kd_Buah'));
      $('[name=harga]').val($(this).attr('Harga'));
      $('[name=harga2]').val($(this).attr('Harga'));
      $('[name=nama]').val($(this).attr('Nama'));
      total_harga();
      $('#cari_buah_penjualan').modal('hide');
       })
      })
     // Tampil Data Pembelian buah
      function loadData(){
        var no_invoice = $('input[name="no_invoice"]').val();
        $.ajax({
          type: 'POST',
          data: 'no_invoice='+no_invoice,
          url: 'tampil_data_pembelian.php',
          success: function(respons) {
            $('#beli_dong').html(respons);
          }
      })
     }

     function tambahDataTransaksi() {
       $('#tambah_transaksi').click(function(e) {
          var admin = $('input[name=admin]').val();
          var pelanggan = $('input[name=pelanggan]').val();
          var no_invoice = $('input[name=no_invoice]').val();
          var tanggal_invoice = $('input[name=tanggal_invoice]').val();
          var subtotal = $('input[name=apalah]').val();
          var diskon = $('input[name=diskon]').val();
          var diskon3 = parseFloat(diskon)/100;
          var total_bayar3 = parseFloat(subtotal) - (parseFloat(diskon3) * parseFloat(subtotal));

          e.preventDefault();
          $.ajax({
            type: 'post',
            url:'tambahkan_transaksi.php',
            data: {admin : admin, pelanggan : pelanggan, no_invoice : no_invoice, tanggal_invoice : tanggal_invoice, subtotal : subtotal, diskon : diskon, total_bayar3 : total_bayar3},
            success : function() {
                      alert("Data Transaksi Berhasil DiTambah");
                      AfterTambahTransaksi();
                      location.reload();
            }
          })
        })
     }
     

     function AfterTambahTransaksi(){
      $('[name=Kd_Buah]').val("");
      $('[name=harga]').val("");
      $('[name=harga2]').val("");
      $('[name=nama]').val("");
      $('[name=jumlah]').val("1");
     }
     window.onload = function(){
      loadData();
      total_harga();
    }
    </script>
    <style type="text/css">
      .alertSukses {
        padding-top: 15px;
        padding-bottom: 15px;
        width: 100%;
        background: yellowgreen;
        border-radius: 3px;
        margin-bottom: 5px;
        padding-left: 20px;
        display: none;
      }
      .alertSukses b {
        color: black;
      }
      footer {
        margin-left: 0;
        position: fixed;
        width: 100%;
        bottom: 0;
      }
    </style>
   <?php
}else{
    header('location: login.php');
}
?>