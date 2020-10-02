<?php
	include 'koneksi.php';
	$id = $_POST['user_id'];
	$foto_lama = $_POST['user_fotolama'];
	$path = 'images/'.$foto_lama;
	$query = mysqli_query($koneksi, "DELETE FROM user WHERE ID = '$id'");
	if ($query) {	
		if (!empty($foto_lama)) {
			unlink($path);
		}
		echo "<script>alert('Data Terhapus'); window.location.href='pengguna.php';</script>";
	}else{
		echo "Maaf Gagal Menghapus Data";
	}
?>