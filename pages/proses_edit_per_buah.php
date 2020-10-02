<?php
	include 'koneksi.php';
	$id = $_POST['id'];
	$no_invoice = $_POST['no_invoice'];
	$tanggal_invoice = $_POST['tanggal_invoice'];
	$Kd_Buah = $_POST['Kd_Buah'];
	$qty = $_POST['jumlah'];
	$totalhargaperproduk = $_POST['total'];

		$sql = "UPDATE detail_pembelian SET Kd_Buah = '$Kd_Buah', Qty = '$qty', No_Invoice = '$no_invoice', Tanggal_Invoice = '$tanggal_invoice', TotalHargaPerProduk = '$totalhargaperproduk' WHERE Pembelian_ID = '$id'";
		$query = mysqli_query($koneksi, $sql);

		if ($query) {
			echo "Data Berhasil di Ubah";
		}else{
			echo "Data Gagal Diubah";
		}

?>