<?php
	include 'koneksi.php';
	$no_invoice = $_POST['no_invoice'];
	$tanggal_invoice = $_POST['tanggal_invoice'];
	$Kd_Buah = $_POST['Kd_Buah'];
	$qty = $_POST['jumlah'];
	$totalhargaperproduk = $_POST['total'];

		$sql = "INSERT INTO detail_pembelian (Kd_Buah, Qty, No_Invoice, Tanggal_Invoice, TotalHargaPerProduk) VALUES('$Kd_Buah', '$qty', '$no_invoice', '$tanggal_invoice', '$totalhargaperproduk')";
		$query = mysqli_query($koneksi, $sql);

		if ($query) {
			echo "Data Produk Ditambahkan";
		}else{
			echo "Data Gagal Ditambahkan";
		}

?>