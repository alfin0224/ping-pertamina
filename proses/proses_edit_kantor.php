<?php 
	include("../koneksi_db/koneksi.php");
	$id = $_POST['id_area'];
	$nama = $_POST['nama_area'];
	$no_telp = $_POST['no_telp'];
	$alamat = $_POST['alamat'];

	if(isset($_POST['simpan'])){
	$sql = mysqli_query($conn, "UPDATE area set nama_area = '$nama', telp_area = '$no_telp', alamat = '$alamat' WHERE id_area = '$id'");
	if($sql){
			echo "<script> alert('Berhasil Mengedit Data Area..');
		window.location.href='../daftar_kantor.php';</script>";
	} else {
			echo "<script> alert('Gagal Mengedit Data Area..');
		window.location.href='../daftar_kantor.php';</script>";
	}
}

 ?>


 