<?php 
	include("../koneksi_db/koneksi.php");
	$user = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);

	if(isset($_POST['login'])){
		$sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' and password = '$pass'");
		$result = mysqli_fetch_array($sql);

		if($result){
			session_start();
			$_SESSION['admin']=$user;
			$_SESSION['role']=$result['role'];
			// echo "<script>
			// window.open('../proses_status.php');</script>";
			echo "<script> alert('Anda Berhasil Login'); 
				window.location.href='../net_monitoring.php' </script>";
		}else{
			echo "<script> alert('Username atau Password anda salah !!');
				window.location.href='../index.php' </script>";
		}
	}
 ?>



 