<?php
	include 'koneksi.php';

	$id = $_POST['user_id'];
	$nama = $_POST['user_nama'];
	$alamat = $_POST['user_alamat'];
	$jeniskelamin = $_POST['user_jeniskelamin'];
	$tempatlahir = $_POST['user_tempatlahir'];
	$tanggallahir = $_POST['user_tanggallahir'];
	$username = $_POST['user_username'];
	
	$nama_foto = $_FILES['user_foto']['name'];
	$tmp_name = $_FILES['user_foto']['tmp_name'];
	$jenis_file = $_FILES['user_foto']['type'];
	$tempat_file = 'images/'.$nama_foto;

	if (!empty($nama_foto)) {
		if ($jenis_file == 'image/png' || $jenis_file == 'image/jpg' || $jenis_file == 'image/bmp') {
			$foto_lama = $_POST['user_fotolama'];
			$path_foto = 'images/'.$foto_lama;
			move_uploaded_file($tmp_name, $tempat_file);
			unlink($path_foto);
			$sql = "UPDATE user SET Nama = '$nama', Alamat = '$alamat', Jenis_Kelamin = '$jeniskelamin', Tempat = '$tempatlahir', Tanggal = '$tanggallahir', Username = '$username', Foto = '$nama_foto' WHERE ID = '$id'";
			$query = mysqli_query($koneksi, $sql);
			if ($query) {
				echo "<script>alert('Data Berhasil Di Ubah'); window.location.href='pengguna.php';</script>";
			}else{
				echo "Maaf Gagal Mengedit Data";
			}
		}else{
			echo "Format Foto Tidak Valid";
		}
	}else{
		$sql = "UPDATE user SET Nama = '$nama', Alamat = '$alamat', Jenis_Kelamin = '$jeniskelamin', Tempat = '$tempatlahir', Tanggal = '$tanggallahir', Username = '$username' WHERE ID = '$id'";
			$query = mysqli_query($koneksi, $sql);
		if ($query) {
			echo "<script>alert('Data Berhasil Di Ubah'); window.location.href='pengguna.php';</script>";
		}else{
			echo "Maaf Gagal Mengedit Data";
		}
	}

?>