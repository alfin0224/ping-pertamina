<?php 
include("../koneksi_db/koneksi.php");
include("cek_login.php");

$username = $_POST['session_aktif'];
$nama = $_POST['nama_lengkap'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = md5($_POST['password']);

$namafile = $_FILES['profile_image']['name'];
$uploadfile = $dir_image . $namafile;





if(isset($_POST['simpan'])){
	if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadfile)) {
		$sql = mysqli_query($conn, "UPDATE user SET nama_lengkap = '$nama', email = '$email', no_hp = '$no_hp', foto = '$namafile', password = '$password' WHERE username = '$username'");
		if($sql){
			echo "<script> alert('Berhasil Mengedit Profile..');
			window.location.href='../profile.php';</script>";
		} else {
			echo "<script> alert('Gagal Mengedit profile..');
			window.location.href='../profile.php';</script>";
		}
	}
}

?>


