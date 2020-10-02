<?php 
	include 'koneksi.php';
	$id_kat = $_POST['ktgr_kategoriid'];

	$sql = "DELETE FROM kategori_buah WHERE KategoriID = '$id_kat'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Telah Di Hapus'); window.location.href='buah_kategori.php';</script>";
	}else{
		echo "Gagal";
	}

?>