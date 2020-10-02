<?php

	include 'koneksi.php';

	$acuanku = $_POST['acuanku'];

	$query = mysqli_query($koneksi, "DELETE FROM detail_pembelian WHERE Pembelian_ID = '$acuanku'");

	if ($query) {
		echo "Data Berhasil Di Hapus";
	}else{
		var_dump($query);
	}

?>
