<?php
	include 'koneksi.php';
	$id_kat = $_POST['ktgr_kategoriid'];
	$nama_kat = $_POST['ktgr_namakategori'];

	$sql = "INSERT INTO kategori_buah (KategoriID, Nama_Kategori) VALUES('$id_kat','$nama_kat')";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Ketegori Berhasil Di Tambahkan'); window.location.href='buah_kategori.php';</script>";
	}else{
		echo "Gagal";
	}
?>