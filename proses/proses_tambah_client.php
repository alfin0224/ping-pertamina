<?php 
include('../koneksi_db/koneksi.php');

$ip_address = $_POST['ip_address'];
$id_area = $_POST['id_area'];
$subnet_mask = $_POST['subnet_mask'];
$vlan = $_POST['vlan'];

	if(isset($_POST['simpan'])){
		$sql = mysqli_query($conn, "INSERT INTO client (ip_address, subnet_mask, vlan, id_area, id_status ) values ('$ip_address','$subnet_mask', '$vlan', '$id_area', 2)");
		
		if($sql){
				echo "<script> alert('Berhasil Menyimpan data Client..');
			window.location.href='../net_monitoring.php';</script>";

		}
	}

?>


