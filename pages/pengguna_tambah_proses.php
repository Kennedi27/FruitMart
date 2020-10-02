<?php
	include 'koneksi.php';

	$nama = $_POST['user_nama'];
	$alamat = $_POST['user_alamat'];
	$jeniskelamin = $_POST['user_jeniskelamin'];
	$tempatlahir = $_POST['user_tempatlahir'];
	$tanggallahir = $_POST['user_tanggallahir'];
	$username = $_POST['user_username'];
	$password = $_POST['user_password'];
	
	$nama_foto = $_FILES['user_foto']['name'];
	$tmp_name = $_FILES['user_foto']['tmp_name'];
	$jenis_file = $_FILES['user_foto']['type'];
	$tempat_file = 'images/'.$nama_foto;

	if ($jenis_file == 'image/png' || $jenis_file == 'image/jpg' || $jenis_file == 'image/bmp') {
		move_uploaded_file($tmp_name, $tempat_file);
		$sql = "INSERT INTO user (Nama, Alamat, Jenis_Kelamin, Tempat, Tanggal, Username, Foto, Password) VALUES('$nama', '$alamat', '$jeniskelamin', '$tempatlahir', '$tanggallahir', '$username', '$nama_foto', '$password')";
		$query = mysqli_query($koneksi, $sql);
		if ($query) {
			echo "<script>alert('Data Berhasil Di Tambahkan'); window.location.href='pengguna.php';</script>";
		}else{
			echo "Maaf Gagal Menambah Data";
		}
	}else{
		echo "Format Foto Tidak Valid";
	}

?>