<?php
session_start();
// Menghapus semua variabel sesi
session_unset();
// menghancurkan sesi
session_destroy();

header("location:login.php");
?>