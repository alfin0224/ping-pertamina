<?php
include '../koneksi_db/koneksi.php';


if (isset($_GET['offset'])) {
	$offset = trim($_GET['offset']);
	$json	= array();
	if (empty($offset)) {
		$offset = 0;
	}else{
		$offset = intval($offset);
	}
	if (is_integer($offset)) {
		$stmt 	= mysqli_prepare($conn, "SELECT * FROM client LIMIT 1 OFFSET ?");
		mysqli_stmt_bind_param($stmt, "i", $_GET['offset']);
		$result = mysqli_stmt_execute($stmt);
		if ($result) {
			$show = $stmt->get_result();
			$json = array();
			while ($data = $show->fetch_assoc()) {
				$ip_client = $data['ip_address'];
				$json[] ="ping -n 1 $ip_client";
			}
		}
	}
	echo json_encode($json);
}