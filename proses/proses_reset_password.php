<?php 
	include("../koneksi_db/koneksi.php");
	$id = $_GET['id_user'];
	$password_default = md5('12345');

	$sql = mysqli_query($conn, "UPDATE user set password = '$password_default' WHERE id_user = '$id'");
	if($sql){
			echo "<script> alert('Berhasil. Password Default Anda adalah 12345');
		window.location.href='../user.php';</script>";
	} else {
			echo "<script> alert('Gagal Mereset Password..');
		window.location.href='../user.php';</script>";
	}

 ?>


 