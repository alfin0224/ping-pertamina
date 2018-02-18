<?php 
	$conn = mysqli_connect("localhost","root","") or die("gagal server");
	mysqli_select_db($conn,"monitoring_pertamina");
	$dir_image = 'C:/xampp/htdocs/ping-pertamina/assets/img/avatars/';
	$url_image = 'http://localhost/ping-pertamina/assets/img/avatars/';
 ?>