<?php
	include 'koneksi.php';

	$idsupplier = $_POST['supplier_idsuplier'];
	$namasupplier = $_POST['supplier_namasuplier'];
	$telp = $_POST['supplier_notelp'];
	$alamat = $_POST['supplier_alamatsuplier'];

	$sql = "INSERT INTO supplier (SupplierID, Nama, NoTelp, Alamat) VALUES('$idsupplier','$namasupplier','$telp','$alamat')";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Berhasil Di Tambah');window.location.href='supplier.php';</script>";
	}else{
		echo "Gagal";
	}
?>