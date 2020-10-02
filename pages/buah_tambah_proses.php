<?php
	include 'koneksi.php';
	$Kd_Buah = $_POST['prdk_Kd_Buah'];
	$namabuah = $_POST['prdk_namabuah'];
	$namasuplier = $_POST['prdk_namasuplier'];
	$namakategori = $_POST['prdk_namakategori'];
	$satuan = $_POST['prdk_satuan'];
	$stok = $_POST['prdk_stok'];
	$hargamodal = $_POST['prdk_hargamodal'];
	$hargajual = $_POST['prdk_hargajual'];

	$sql = "INSERT INTO buah (Kd_Buah, Nama, SupplierID, KategoriID, Satuan, Stok, Harga_Modal, Harga_Jual) VALUES ('$Kd_Buah', '$namabuah', '$namasuplier', '$namakategori', '$satuan', '$stok', '$hargamodal', '$hargajual')";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Berhasil Di Tambah'); window.location.href='buah.php';</script>";;
	}else{
		echo  $sql;
	}
?>