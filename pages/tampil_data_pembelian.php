<?php
  include 'koneksi.php';
?>
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
    $no_invoice = $_POST['no_invoice']; 
    if ($no_invoice == "") {
      echo "<td colspan ='6'>Belum Ada Item</td>";
    }else{
      $sql = "SELECT P.*, D.* FROM detail_pembelian as D, buah as P WHERE P.Kd_Buah = D.Kd_Buah AND No_Invoice = '$no_invoice'";
    $query = mysqli_query($koneksi, $sql);
    $no = 1;
    $total_jumlah_barang = 0;
    $total_harga_total_per_buah = 0;
    $total_harga_satuan_buah = 0;
    while ($data = mysqli_fetch_array($query)) {
  ?>
  <input type="hidden" name="rujukan" value="<?php echo $data['Pembelian_ID']; ?>">
  <input type="hidden" name="no_invoice" value="<?php echo $no_invoice; ?>">
    <tr>
      <td><?php echo $data['Kd_Buah']; ?></td>
      <td><?php echo $data['Nama']; ?></td>
      <td><?php echo number_format($data['Harga_Jual'], 2); ?></td>
      <td><?php echo $data['Qty']; ?></td>
      <td><?php echo number_format($data['TotalHargaPerProduk'],2); ?></td>
      <td>
        <button Pembelian_ID="<?php echo $data['Pembelian_ID']; ?>" id="HapusPerbuah" onclick="listbuahhapus($(this).attr('Pembelian_ID'))" type="button" class="btn btn-danger"><span class="ion ion-android-close"></span> Batal</button> 
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
  <tr>
    <td><b>Diskon</b></td>
    <td><input type="number" value="0" onclick="ttl_bayar()" onkeyup="ttl_bayar();" name="diskon" id="diskon" class="form-control" style="float: left; width: 150px;"> <b style="float: right;">%</b></td>
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
<script type="text/javascript">

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

  function listbuahhapus(acuanku) {
    $.ajax({
      type : 'POST',
      data : 'acuanku='+acuanku,
      url : 'hapus_list_buah.php',
      success : function() {
        location.reload();
      }
    })
  }
</script>