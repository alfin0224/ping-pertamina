<?php 
	include('../koneksi_db/koneksi.php');
	$id_client = $_GET['id_client'];
	$sql = mysqli_query($conn, "DELETE FROM client WHERE id_client = '$id_client'");

	mysqli_close();
	header("Location: ../net_monitoring.php?page=1");
 ?>


 