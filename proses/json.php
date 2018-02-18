<?php
include '../koneksi_db/koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (isset($_GET['id'])) {

	$stmt = mysqli_prepare($conn, "SELECT * FROM client WHERE id_area = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
	$result = mysqli_stmt_execute($stmt);
	if ($result) {
		$show = $stmt->get_result();
		$json = array();
		while ($data = $show->fetch_assoc()) {
			//$json[] = $data;
			$idClient = $data['id_client'];
			$ip_client = $data['ip_address'];
			$id_status = $data['id_status'];

			$cmd = shell_exec("ping -n 1 $ip_client");
        	//nilai received
			$received_mentah = explode(",",$cmd);
			$received_mentah = ($received_mentah[1]);
			$received_matang = substr($received_mentah,12,1);

        	//nilai lost
			$lost_mentah = explode(",",$cmd);
			$lost_mentah = ($lost_mentah[2]);
			$lost_matang = substr($lost_mentah, 8, 1);
			$query_lost_received ="UPDATE client SET lost=$lost_matang, received=$received_matang where id_client = $idClient";

			$sql_lost_received = mysqli_query($conn, $query_lost_received);


        	//nilai minimal
			$min = explode(",",$cmd);
			$min = ($min[3]);
			$min_fix = substr($min,62,3);

        	//nilai maksimal
			$max = explode(",",$cmd);
			if(isset($max)){
				$max = ($max[4]);
				$max_fix = substr($max,11,3);
			}
        	//nilai average
			$avg = explode(",",$cmd);
			$avg = ($avg[5]);
			$avg_fix = substr($avg,11,3);

			if (filter_var($avg_fix, FILTER_VALIDATE_INT)){
				$query_kecepatan = "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = $idClient";
				$sql_kecepatan = mysqli_query($conn, $query_kecepatan);

			}else if(!filter_var($avg_fix, FILTER_VALIDATE_INT)){
				if (empty($avg_fix)) {
					$query_kecepatan =  "UPDATE client SET minimum=0, maksimum=0, average=0 where id_client = $idClient";
					$sql_kecepatan = mysqli_query($conn, $query_kecepatan);
					$min_fix = '-';
					$max_fix = '-';
					$avg_fix = '-';
				} else {
					$min_fix = substr($min_fix,0,1);
					$max_fix = substr($max_fix,0,1);
					$avg_fix = substr($avg_fix,0,1);
					$query_kecepatan = "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = $idClient";
					$sql_kecepatan = mysqli_query($conn, $query_kecepatan);
				}

			}
			
			$id_status_baru=1;
			if($received_matang >= 1){
				if (!filter_var($avg_fix, FILTER_VALIDATE_INT)) {
					$id_status_baru = 3;
				} else {
					$id_status_baru = 1;
				}

			} else if($lost_matang >= 1) {
				$id_status_baru = 2;

			} 

			$sql_status = mysqli_query($conn, "UPDATE client SET id_status=$id_status_baru where id_client = $idClient");

			$json[] = array(
				'ip_client'=>$ip_client,
				'received_matang'=>$received_matang.' ms',
				'lost_matang'=>$lost_matang.' ms',
				'min_fix'=>$min_fix,
				'max_fix'=>$max_fix,
				'avg_fix'=>$avg_fix,
				'id_status'=>$id_status_baru,
				);
		}
		echo json_encode($json);
	}
}