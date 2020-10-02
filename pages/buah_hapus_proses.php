<?php
	include 'koneksi.php';
	$Kd_Buah = $_POST['prdk_Kd_Buah'];

	$sql = "DELETE FROM buah WHERE Kd_Buah = '$Kd_Buah'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Berhasil Di Hapus'); window.location.href='buah.php';</script>";;
	}else{
		echo $sql;
	}
?>