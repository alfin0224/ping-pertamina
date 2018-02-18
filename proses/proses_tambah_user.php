<?php 
include('../koneksi_db/koneksi.php');

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];
$no_hp = $_POST['no_hp'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']); 

if(isset($_POST['simpan'])){
	if ($password == $confirm_password) {
		$sql = mysqli_query($conn, "INSERT INTO user (email, username, role, password) values ('$email', '$username', '$role', '$password')");
		if($sql){
			echo "<script> alert('Berhasil Menyimpan User Baru..');
			window.location.href='../user.php';</script>";

		}
	} else{
		echo "<script> alert('Password not Match.');
		window.location.href='../form_tambah_user.php';</script>";
	}

}

?>


