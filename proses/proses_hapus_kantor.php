<?php 
	include('../koneksi_db/koneksi.php');
	$id_area = $_GET['id_area'];
	$sql = mysqli_query($conn, "DELETE FROM area WHERE id_area = '$id_area'");

	mysqli_close();
	header("Location: ../daftar_kantor.php");
 ?>


 