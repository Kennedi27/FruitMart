<?php
	include 'koneksi.php';
	$tanggaldari = $_POST['laporan_tanggaldari'];
	$tanggalke = $_POST['laporan_tanggalke'];

  if ($tanggalke == "") {
    $tanggalke = $tanggaldari;
  }

?>
<div id="printaja">
  <table id="example2" class="table table-bordered table-hover display">
      <thead>
        <tr>
          <th>No.</th>
          <th>No. Invoice</th>
          <th>Tanggal</th>
          <th>Pelanggan</th>
          <th>Admin</th>
          <th>Sub Total</th>
          <th>Diskon (%)</th>
          <th>Total Bayar (Rp.)</th>
          <th>Modal (Rp.)</th>
          <th>Laba (Rp.)</th>
        </tr>
      </thead>
      <tbody>
      	<?php 
      		$no = 1;
          $totallaba = 0;
          $totalmodal = 0;
          $totalpembayaran = 0;
          $subtotal = 0;
      		$sql = "SELECT * FROM pembelian WHERE Tanggal_Invoice >= '$tanggaldari' AND Tanggal_Invoice <= '$tanggalke'";
      		$query = mysqli_query($koneksi, $sql);
      		while ($data = mysqli_fetch_array($query)) {
            $NamaPelanggan = $data['pelanggan'];
            if ($NamaPelanggan == "") {
              $NamaPelanggan = "No Name";
            }else{
              $NamaPelanggan = $data['pelanggan'];
            }
            $no_inv = $data['No_Invoice'];
            $query1 = mysqli_query($koneksi, "SELECT NoInvoice, Qty, SUM(HargaModal) as modal FROM join_buah WHERE NoInvoice = '$no_inv' GROUP BY NoInvoice");
            $data1 = mysqli_fetch_array($query1);
            $modal = $data1['modal'] * $data1['Qty'];
            $subsubharga = $data['SubHarga'];
            $totalBayar = $data['TotalHarga'];
            $laba = $totalBayar - $modal;
      	?>
    		    <tr>
    		        <td><?php echo $no++; ?></td>
    		        <td><?php echo $data['No_Invoice']; ?></td>
    		        <td><?php echo $data['Tanggal_Invoice']; ?></td>
    		        <td><?php echo $NamaPelanggan; ?></td>
    		        <td><?php echo $data['admin']; ?></td>
    		        <td><?php echo number_format($subsubharga, 2); ?></td>
    		        <td><?php echo $data['Diskon']; ?></td>
    		        <td><?php echo number_format($totalBayar, 2); ?></td>
    		        <td><?php echo number_format($modal, 2); ?></td>
    		        <td><?php echo number_format($laba, 2); ?></td>
    		    </tr>
    		<?php
            $totallaba = $totallaba + $laba;
            $totalmodal = $totalmodal + $modal;
            $totalpembayaran = $totalpembayaran + $totalBayar;
            $subtotal = $subtotal + $subsubharga;
          } 
        ?>
      </tbody>
      <tfoot class="bg-info">
        <tr>
          <th colspan="4"></th>
          <th>Total</th>
          <th><?php echo "Rp. ".number_format($subtotal, 2); ?></th>
          <th></th>
          <th><?php echo "Rp. ".number_format($totalpembayaran, 2); ?></th>
          <th><?php echo "Rp. ".number_format($totalmodal, 2); ?></th>
          <th><?php echo "Rp. ".number_format($totallaba, 2); ?></th>
        </tr>
      </tfoot>
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
              extend : 'pdf',
              orientation : 'potrait',
              pageSize : 'A4',
              title : 'LAPORAN PENJUALAN FRUIT MART',
              className : 'btn btn-primary',
              download : 'open'
            },
            {
              extend : 'print',
              className : 'btn btn-success',
              title : 'LAPORAN PENJUALAN FRUIT MART'
            }
        ]
    } );
} );
</script>


