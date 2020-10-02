<?php
	include 'koneksi.php';
	$admin = $_POST['admin'];
	$pelanggan = $_POST['pelanggan'];
	$no_invoice = $_POST['no_invoice'];
	$tanggal_invoice = $_POST['tanggal_invoice'];
	$subtotal = $_POST['subtotal'];
	$diskon = $_POST['diskon'];
	$total_bayar3 = $_POST['total_bayar3'];

	$sql = "UPDATE pembelian SET SubHarga = '$subtotal', Diskon = '$diskon', TotalHarga = '$total_bayar3', admin = '$admin', pelanggan = '$pelanggan', Tanggal_Invoice = '$tanggal_invoice' WHERE No_Invoice = '$no_invoice'";
	$query = mysqli_query($koneksi, $sql);

	if (!$query) {
		echo "Gagal Menambah data";
	}else{
		echo "Berhasil Mengedit Data";
	}

?>