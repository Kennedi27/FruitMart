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

	$sql = "UPDATE buah SET Nama = '$namabuah', SupplierID = '$namasuplier', KategoriID = '$namakategori', Satuan = '$satuan', Stok = '$stok', Harga_Modal = '$hargamodal', Harga_Jual = '$hargajual' WHERE Kd_Buah = '$Kd_Buah'";
	$query = mysqli_query($koneksi, $sql);

	if ($query) {
		echo "<script>alert('Data Berhasil Di Diubah'); window.location.href='buah.php';</script>";;
	}else{
		echo $sql;
	}
?>