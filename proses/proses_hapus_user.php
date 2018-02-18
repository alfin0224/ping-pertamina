<?php 
	include('../koneksi_db/koneksi.php');
	$id_user = $_GET['id_user'];
	$sql = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id_user'");

	mysqli_close();
	header("Location: ../user.php");
 ?>


 