<?php 
include('../koneksi_db/koneksi.php');

$nama = $_POST['nama_area'];
$no_telp = $_POST['telp_area'];
$alamat = $_POST['alamat'];

	if(isset($_POST['simpan'])){
		$sql = mysqli_query($conn, "INSERT INTO area (nama_area, telp_area, alamat) values ('$nama', '$no_telp', '$alamat')");
		
		if($sql){
				echo "<script> alert('Berhasil Menyimpan data Kantor..');
			window.location.href='../daftar_kantor.php';</script>";

		}
	}

?>


