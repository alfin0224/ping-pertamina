<?php 
	include("../koneksi_db/koneksi.php");
	// include("cek_login.php");
	$id = $_POST['id_client'];
	$ip_address = $_POST['ip_address'];
	$id_area = $_POST['id_area'];

	if(isset($_POST['simpan'])){
	$sql = mysqli_query($conn, "UPDATE client set ip_address = '$ip_address', id_area = '$id_area' WHERE id_client = '$id'");
	if($sql){
			echo "<script> alert('Berhasil Mengedit Client..');
		window.location.href='../net_monitoring.php';</script>";
	} else {
			echo "<script> alert('Gagal Mengedit Client..');
		window.location.href='../net_monitoring.php';</script>";
	}
}

 ?>


 