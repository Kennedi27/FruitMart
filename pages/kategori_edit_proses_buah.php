<?php
	include 'koneksi.php';
	$id_kat = $_POST['ktgr_kategoriid'];
	$nama_kat = $_POST['ktgr_namakategori'];

	$sql = "UPDATE kategori_buah SET Nama_Kategori = '$nama_kat' WHERE KategoriID = '$id_kat'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Ketegori Berhasil Di Ubah'); window.location.href='buah_kategori.php';</script>";
	}else{
		echo "Gagal";
	}
?>