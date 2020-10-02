<?php 
	include 'koneksi.php';

	$id = $_POST['supplier_idsuplier'];

	$sql = "DELETE FROM supplier WHERE SupplierID = '$id'";
	$query = mysqli_query($koneksi, $sql);
	if ($query) {
		echo "<script>alert('Data Telah Di Hapus');</script>";
		header('location: supplier.php');
	}else{
		echo "gagal";
	}
?>