<?php 
	include("../koneksi_db/koneksi.php");
	// include("cek_login.php");
	if (isset($_POST)) {
		$data = $_POST;
		if (isset($data['simpan']) && isset($data['id_client'])) {
			unset($data['simpan']);
			unset($data['id_client']);
			$set_update ='set ';
			$x = 0;
			foreach ($data as $key => $value) {
				
				if ($x != 0 ) {
					$set_update .=' ,'.$key.' = "'.$value.'" ';
				}else{
					$set_update .=' '.$key.' = "'.$value.'"';
				}
				$x++;
			}
		}
	}
	$id = $_POST['id_client'];
	if(isset($_POST['simpan'])){
		$stmt_update = "UPDATE client $set_update WHERE id_client = ".$id;
		$sql = mysqli_query($conn, $stmt_update);
	if($sql){
			echo "<script> alert('Berhasil Mengedit Client..');
		window.location.href='../net_monitoring.php';</script>";
	} else {
			echo "<script> alert('".$stmt_update."');
		window.location.href='../net_monitoring.php';</script>";
	}
}

 ?>


 