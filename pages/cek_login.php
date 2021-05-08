<?php
// mengaktifkan sseion php
session_start();
// menghubungkan dengan koneksi
include 'koneksi.php';
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM user WHERE Username='$username' AND Password='$password'");
if(mysqli_num_rows($data)>0){
    $row= mysqli_fetch_object($data);//membuat session
        $_SESSION['user'] = $row->Username;
        $_SESSION['name'] = $row->Nama;
        $_SESSION['pass'] = $row->Password;
        $_SESSION['address'] = $row->Alamat;
        $_SESSION['foto'] = $row->Foto;	

        header("location:../index.php");
    }else{
	
?>
    <div class="alert alert-Danger">
        <script language="javascript">
	       alert('Data Anda Tidak Valid');
	       document.location="login.php";
  	    </script>
    </div>

<?php }
