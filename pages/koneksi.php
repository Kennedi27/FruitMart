<?php
	
	$user = "root";
	$pass = "";
	$host = "localhost";
	$dbname = "fruitmart";

	$koneksi = mysqli_connect($host, $user, $pass, $dbname);
	 if (!$koneksi) {
	 		echo "Gagal Terhubung ke Db";
	 }
?>