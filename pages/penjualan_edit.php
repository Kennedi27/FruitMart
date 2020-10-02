<?php
session_start();
$akses=$_SESSION['user'];
 include 'koneksi.php';
 $sql = mysqli_query($koneksi,"select * from user");

 if(empty($_SESSION['user']) or empty($_SESSION['pass'] == 0)){
  header('location: login.php');
}else{
?>
<?php 
error_reporting(0);
  include 'koneksi.php';
  $id = $_GET['id'];
  if($id == ""){
    $id = "B0001";
  }
    $acuanedit = $_GET['No_Invoice'];
?>
  <?php include 'template/header.php'; ?>
  <body class="skin-blue sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px;">
      <?php 
        include 'template/navigasi.php';
      ?>
      
      <?php
        include 'template/sidebar.php';
      ?>
      <!-- Kontent -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="row"></div>
          <section class="content-header">
          <h1>
            Penjualan
            <small>Ubah Penjualan</small>
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
                        <label class="label-control">Admin :</label><br>
                        <input type="text" name="admin2" disabled="disabled" value="<?php echo $_SESSION['name']; ?>" class="form-control">
                        <input type="hidden" name="admin" value="<?php echo $_SESSION['name']; ?>">
                      </div>
                      <?php
                        $data02 = $acuanedit;
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
                    <?php
                      $sequel = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE No_Invoice = '$acuanedit'");
                      $duel = mysqli_fetch_array($sequel);
                      $tampil_nama_pengguna = $duel['pelanggan'];
                    ?>
                      <div class="col-md-3">
                        <label class="label-control">Pelanggan</label><br>
                        <input type="text" name="pelanggan" class="form-control" value="<?php echo $tampil_nama_pengguna; ?>">
                      </div>
                    </div>

                    <div class="row" style="padding-top: 40px;">
                      <div class="col-md-3">
                        <h4><b>Edit Pembelian</b></h4>  
                    <?php
                      $sql = mysqli_query($koneksi, "SELECT * FROM buah WHERE Kd_Buah = '$id'");
                      while ($data = mysqli_fetch_array($sql)) {
                        $id_buah = $data['Kd_Buah'];
                        $nama_buah = $data['Nama'];
                        $harga_buah = number_format($data['Harga_Jual'],2);
                    ?>
                        <div class="form-group">
                          <label class="label-control">Kode Buah</label><br>
                          <input type="text" name="Kd_Buah" class="form-control" style="width: 50%; float: left;">
                          <a data-toggle="modal" data-target="#cari_buah_penjualan"><button class="btn btn-success" style="float: right;"><span class="ion ion-android-search"></span> Cari Buah</button></a>
                        </div><br>
                        <div class="form-group">
                          <label class="label-control" style="padding-top: 20px; padding-left: 0; margin-left: 0;">buah : </label>
                          <input type="text" name="nama" class="form-control" disabled>
                          <input type="hidden" name="bakpao">
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
                          <input id="TambahListbuah" type="submit" name="submit" class="btn btn-success form-control" value="Tambahkan">
                          <button type="button" id="EditListbuah" class="btn btn-warning form-control">Simpan</button>
                        </div>
                      <?php
                        }
                      ?>
                      </div>
                    </form>
                    <!-- </form> -->
                      <div class="col-md-9">
                        <h4><b>Daftar Pembelian</b></h4>
                          <div class="alertSukses">
                            <b id="alertSukses"></b>
                          </div>
                        
                          <div id="menampilkan_buah">
                            <table id="menampilkan_buah2" class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Kode buah</th>
                                  <th>Nama buah</th>
                                  <th>Harga</th>
                                  <th>Jumlah</th>
                                  <th>Total</th>
                                  <th>Opsi</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                // error_reporting(0);
                                if ($acuanedit == "") {
                                  echo "<td colspan ='6'>Belum Ada Item</td>";
                                }else{
                                  $sql = "SELECT P.*, D.* FROM detail_pembelian as D, buah as P WHERE P.Kd_Buah = D.Kd_Buah AND No_Invoice = '$acuanedit'";
                                $query = mysqli_query($koneksi, $sql);
                                $no = 1;
                                $total_jumlah_barang = 0;
                                $total_harga_total_per_buah = 0;
                                $total_harga_satuan_buah = 0;
                                while ($data = mysqli_fetch_array($query)) {
                              ?>
                              <input type="hidden" name="rujukan" value="<?php echo $data['Pembelian_ID']; ?>">
                                <tr>
                                  <td><?php echo $data['Kd_Buah']; ?></td>
                                  <td><?php echo $data['Nama']; ?></td>
                                  <td><?php echo "Rp. ".number_format($data['Harga_Jual'], 2); ?></td>
                                  <td><?php echo $data['Qty']; ?></td>
                                  <td><?php echo "Rp. ".number_format($data['TotalHargaPerProduk'],2); ?></td>
                                  <td>
                                    <a class="baedit_data_penjualan" Pembelian_ID="<?php echo $data['Pembelian_ID']; ?>"  Jumlah="<?php echo $data['Qty']; ?>" Kd_Buah="<?php echo $data['Kd_Buah']; ?>" Nama="<?php echo ucfirst($data['Nama']); ?>" Harga="<?php echo $data['Harga_Jual']; ?>" href="penjualan_edit.php?No_Invoice=<?php echo $data['No_Invoice'] ?>&id=<?php echo $data['Kd_Buah']; ?>"><button type="button" class="btn btn-info"><span class="ion ion-plus"></span> Edit</button></a>

                                    <button Pembelian_ID="<?php echo $data['Pembelian_ID']; ?>" id="HapusPerbuah" onclick="listbuahhapus($(this).attr('Pembelian_ID'))" type="button" class="btn btn-danger"><span class="ion ion-android-close"></span> Hapus</button> 
                                  </td>
                                </tr>
                              <?php
                                  $no++;
                                  $jumlah_barang_dibeli = $data['Qty'];
                                  $harga_total_per_buah = $data['TotalHargaPerProduk'];
                                  $harga_satuan_buah = $data['Harga_Jual'];
                                  $total_jumlah_barang = $total_jumlah_barang + $jumlah_barang_dibeli;
                                  $total_harga_total_per_buah = $total_harga_total_per_buah + $harga_total_per_buah; 
                                  $total_harga_satuan_buah = $total_harga_satuan_buah + $harga_satuan_buah;  
                                }
                              }
                              ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th colspan="2" style="text-align: right;">Total</th>
                                  <th><?php echo "Rp. ".number_format($total_harga_satuan_buah, 2); ?></th>
                                  <th><?php echo $total_jumlah_barang; ?></th>
                                  <th><?php echo "Rp. ".number_format($total_harga_total_per_buah, 2); ?></th>
                                </tr>
                              </tfoot>
                            </table>
                            <table style ="width:450px;" class="table table-bordered table-hover">
                            <tbody>
                              <tr>
                                <td width="240"><b>Sub Total Pembelian</b></td>
                                <td><?php echo "Rp. ".number_format($total_harga_total_per_buah, 2); ?></td>
                                <input type="hidden" name="subtotal" value="<?php echo $total_harga_total_per_buah; ?>">
                              </tr>

                              <?php
                                $sql01 = "SELECT * FROM pembelian WHERE No_Invoice = '$acuanedit'";
                                $query01 = mysqli_query($koneksi, $sql01);
                                $data01 = mysqli_fetch_array($query01);
                                $diskontransaksi = $data01['Diskon'];
                              ?>
                              <tr>
                                <td><b>Diskon</b></td>
                                <td><input type="number" value="<?php echo $diskontransaksi; ?>" onclick="ttl_bayar()" onkeyup="ttl_bayar();" name="diskon" id="diskon" class="form-control" style="float: left; width: 150px;"> <b style="float: right;">%</b></td>
                                <?php
                                  
                                ?>
                                <input type="hidden" name="apalah" id="total_harga_total_per_buah" value="<?php echo $total_harga_total_per_buah; ?>">
                              </tr>
                              <tr>
                                <td><b>Total Bayar</b></td>
                                <td><span id="total_pembayaran"><?php echo "Rp. ".number_format($total_harga_total_per_buah, 2); ?></span></td>
                                <input type="hidden" name="total_bayar3" id="total_bayar3" value="0">
                              </tr>
                            </tbody>
                            </table>
                            </div>
                          <button id="simpan_transaksi" class="btn btn-warning" style="float: right; font-weight: bold;"><span class="ion ion-checkmark"></span> Simpan Transaksi</button>

                      </div>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
        </div>
      </section>
    </div>
      <!-- /Kontent -->
      <?php include 'template/footer.php'; ?>
      
<?php
  include 'form_proses.php';
?>
<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": true
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        AmbilDatabuah();
        AmbilDatabuahDariList();
        TambahbuahkeList();
        SimpanListbuah();
        editDataTransaksi();
      })

      function ttl_bayar() {
            var diskon = document.getElementById('diskon').value;
            var total_harga_total_per_buahKU = document.getElementById('total_harga_total_per_buah').value;
            var diskon2 = parseFloat(diskon) / 100;
            var total_beli = parseFloat(total_harga_total_per_buahKU) - (parseFloat(diskon2) * parseFloat(total_harga_total_per_buahKU));
            var hasil_total = (total_beli/1000).toFixed(3);
            var ganti_koma;
            if (total_beli <= 0) {
              ganti_koma = 0;
            }else{
              ganti_koma = hasil_total.replace(".", ",");
           }
           document.getElementById('total_pembayaran').innerHTML = "Rp. "+ganti_koma+".00";
        }

      function loadTablebuah() {
          var alamaturl = location.href;
          $('#menampilkan_buah').load(alamaturl+' #menampilkan_buah');
        }
      function listbuahhapus(acuanku) {
          $.ajax({
            type : 'POST',
            data : 'acuanku='+acuanku,
            url : 'hapus_list_buah.php',
            success : function(respond) {
              loadTablebuah();
              $('#alertSukses').html(respond);
                $(".alertSukses").fadeIn(1000, function(){
                $('.alertSukses').slideUp(4000);
                });
            }
          })
        }

      function AmbilDatabuah() {
            $('.tambah_data_penjualan').click(function(e) {
            e.preventDefault();
            $('[name=Kd_Buah]').val($(this).attr('Kd_Buah'));
            $('[name=harga]').val($(this).attr('Harga'));
            $('[name=harga2]').val($(this).attr('Harga'));
            $('[name=nama]').val($(this).attr('Nama'));
            $('[name=jumlah]').val($(this).attr('Jumlah'));
            total_harga();
          })
        }

      function AmbilDatabuahDariList() {
            $('.baedit_data_penjualan').click(function(e) {
            e.preventDefault();
            $('[name=bakpao]').val($(this).attr('Pembelian_ID'));
            $('[name=Kd_Buah]').val($(this).attr('Kd_Buah'));
            $('[name=harga]').val($(this).attr('Harga'));
            $('[name=harga2]').val($(this).attr('Harga'));
            $('[name=nama]').val($(this).attr('Nama'));
            $('[name=jumlah]').val($(this).attr('Jumlah'));
            TampilTombolEditListbuah();
            total_harga();
          })
        }

      function AfterEditListbuah(){
          $('[name=Kd_Buah]').val("");
          $('[name=harga]').val("");
          $('[name=harga2]').val("");
          $('[name=nama]').val("");
          $('[name=jumlah]').val("1");
          $('[name=total]').val("0");
         }

      function TambahbuahkeList() {
          $('#form').on('submit', function(e){
              e.preventDefault();
              $.ajax({
              type: $(this).attr('method'),
              url : $(this).attr('action'),
              data: $(this).serialize(),
              success : function(respond){
                loadTablebuah();
                $('#alertSukses').html(respond);
                $(".alertSukses").fadeIn(1000, function(){
                $('.alertSukses').slideUp(4000);
                AfterEditListbuah();
                });
              }
            });
          })
        }
        
      function TampilTombolEditListbuah() {
          document.getElementById('EditListbuah').style.display = "block";
          document.getElementById('TambahListbuah').style.display = "none";
        }

      function SimpanListbuah() {
            $('#EditListbuah').click(function(e) {
              e.preventDefault();
              var id = $('input[name=bakpao]').val();
              var no_invoice = $('input[name=no_invoice]').val();
              var tanggal_invoice = $('input[name=tanggal_invoice]').val();
              var Kd_Buah = $('input[name=Kd_Buah]').val();
              var jumlah = $('input[name=jumlah]').val();
              var total = $('input[name=total]').val();
              
              $.ajax({
                type : 'POST',
                url : 'proses_edit_per_buah.php',
                data : {id : id, no_invoice : no_invoice, tanggal_invoice : tanggal_invoice, Kd_Buah : Kd_Buah, jumlah : jumlah, total : total},
                success : function(respond){
                  loadTablebuah();
                  $('#alertSukses').html(respond);
                  $(".alertSukses").fadeIn(1000, function(){
                  $('.alertSukses').slideUp(4000);
                  
                });
                }
            })
          })
        }

      function editDataTransaksi() {
       $('#simpan_transaksi').click(function(e) {
          e.preventDefault();
          var admin = $('input[name=admin]').val();
          var pelanggan = $('input[name=pelanggan]').val();
          var no_invoice = $('input[name=no_invoice]').val();
          var tanggal_invoice = $('input[name=tanggal_invoice]').val();
          var subtotal = $('input[name=apalah]').val();
          var diskon = $('input[name=diskon]').val();
          var diskon3 = parseFloat(diskon)/100;
          var total_bayar3 = parseFloat(subtotal) - (parseFloat(diskon3) * parseFloat(subtotal));
          $.ajax({
            type: 'post',
            url:'edit_transaksi.php',
            data: {admin : admin, pelanggan : pelanggan, no_invoice : no_invoice, tanggal_invoice : tanggal_invoice, subtotal : subtotal, diskon : diskon, total_bayar3 : total_bayar3},
            success : function(respond) {
                      alert(respond);
                      window.location.href = 'penjualan_data.php';
            }
          })
        })
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
      #EditListbuah {
        display: none;
      }
</style>
<?php } ?>