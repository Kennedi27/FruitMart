<?php
	include 'koneksi.php';
	$invoiceno = $_GET['invoiceno'];

	$sql = "DELETE FROM pembelian WHERE No_Invoice = '$invoiceno'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		header("location: penjualan_data.php");
	}else{
		echo $sql;
	}

?>