<?php
session_start();
if(!isset($_SESSION['admin'])){
	echo "<script> alert('Tidak di perbolehkan masuk, silahkan login terlebih dahulu :) ');
	window.location.href='index.php' </script>";
} else {
	$user = $_SESSION['admin'];
}
?>