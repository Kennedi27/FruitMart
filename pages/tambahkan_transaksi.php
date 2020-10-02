<?php
	include 'koneksi.php';
	$admin = $_POST['admin'];
	$pelanggan = $_POST['pelanggan'];
	$no_invoice = $_POST['no_invoice'];
	$tanggal_invoice = $_POST['tanggal_invoice'];
	$subtotal = $_POST['subtotal'];
	$diskon = $_POST['diskon'];
	$total_bayar3 = $_POST['total_bayar3'];

	$sql = "INSERT INTO pembelian (No_Invoice, SubHarga, Diskon, TotalHarga, admin, pelanggan, Tanggal_Invoice) VALUES ('$no_invoice','$subtotal','$diskon','$total_bayar3','$admin','$pelanggan','$tanggal_invoice')";
	$query = mysqli_query($koneksi, $sql);

	if (!$query) {
		echo "Gagal Menambah data";
	}

?>