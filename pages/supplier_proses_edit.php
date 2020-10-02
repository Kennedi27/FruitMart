<?php
	include 'koneksi.php';

	$idsupplier = $_POST['supplier_idsuplier'];
	$namasupplier = $_POST['supplier_namasuplier'];
	$telp = $_POST['supplier_notelp'];
	$alamat = $_POST['supplier_alamatsuplier'];

	$sql = "UPDATE supplier SET Nama = '$namasupplier', NoTelp = '$telp', Alamat = '$alamat' WHERE SupplierID = '$idsupplier'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Berhasil Di Ubah');window.location.href='supplier.php';</script>";
	}else{
		echo "Gagal";
	}
?>